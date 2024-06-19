@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <main class="text-center mt-5" style="max-width: 400px; margin: 80px auto;">
        <div class="search">
            <h3>@lang('main.track_input')</h3>
            <div class="input-group">
                <input autocomplete="off" type="text" name="search" id="search" placeholder="@lang('main.track_input')"
                       class="form-control"/>
                <div class="input-group-append">
                    <button id="search_button"><img src="{{  asset('image/search-user.png') }}" alt="Search User png">
                    </button>
                </div>
            </div>

            <ul class="search-result"></ul>
        </div>


        <h4 class="fz-16 main-title mt-5 text-left">@lang('main.last_search')</h4>
        @if(session()->has('searched'))
            @php
                $array = session()->get('searched');

            @endphp
            <div class="d-flex flex-wrap badges justify-content-start mt-3" style="gap: 10px;">

                @foreach($array as $value)
                    @if(App\Models\Cargo::where('id', $value)->exists())
                        @php
                            $cargo = App\Models\Cargo::find($value);
                        @endphp
                        <div class="badge"><a
                                    href="{{ route('show_cargo', $cargo->id) }}">№{{ $cargo->track_number }}</a>&nbsp;&nbsp;
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {



            var search_ul = $('.search-result');
            $(document).on('keyup', '#search', function (e) {
                var query = $(this).val();
                if (e.which !== 13) {
                    if (query == "" || query.length < 1) {
                        search_ul.css('display', 'none');
                    } else {
                        search_ul.css('display', 'block');
                        fetch_customer_data(query);
                    }
                }

            });

            $(document).on('click', '#search_button', function () {
                var query = $('#search').val();
                search_ul.css('display', 'block');
                fetch_customer_data(query);
            });

            $('#search').keypress(function (e) {
                if (e.which == 13) {
                    $('#search_button').click();
                }
            });

            function fetch_customer_data(query = '') {
                $.ajax({
                    url: "{{ route('live_search') }}",
                    method: 'GET',
                    data: {query: query},
                    dataType: 'json',
                    success: function (data) {
                        search_ul.html(data.data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }


            var search_by_code_ul = $('.search_by_code-result');
            $(document).on('keyup', '#search_by_code', function (e) {
                var query_ = $(this).val();
                if (e.which !== 13) {
                    if (query_ === "") {
                        search_by_code_ul.css('display', 'none');
                    } else {
                        fetch_customer_bycode_data(query_);
                    }
                }

            });

            $(document).on('click', '#search_by_code_button', function () {
                var query_ = $('#search_by_code').val();
                if (query_ === "") {
                    search_by_code_ul.css('display', 'none');
                } else {
                    fetch_customer_bycode_data(query_);
                }
            });

            $('#search_by_code').keypress(function (e) {
                if (e.which == 13) {
                    $('#search_by_code_button').click();
                }
            });

            function fetch_customer_bycode_data(query = '') {
                $.ajax({
                    url: "{{ route('live_search_by_code') }}",
                    method: 'GET',
                    data: {query: query},
                    dataType: 'json',
                    success: function (data) {
                        if (data.success){
                            search_by_code_ul.css('display', 'table-row-group');
                            search_by_code_ul.html(data.data);
                            $(".clickable-row").click(function() {
                                window.location = $(this).data("href");
                            });
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });

    </script>
@endpush
