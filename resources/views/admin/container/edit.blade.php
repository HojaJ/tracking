@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

@endpush
@section('content')
    <main class="mt-lg-5 mt-3">
        <div class="container pos-re">
            <form action="{{route('admin.container.update', $container->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Названия</label>
                                    <input type="text" name="name" class="form-control" placeholder="Названия" value="{{ $container->name }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Отправить в контейнеры (Назад)</label>
                                    <select name="in_arhive" class="form-control">
                                        <option value="0">Не в архиве</option>
                                        <option value="1" selected>В архиве</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Введите свой комментарий</label>
                                    <input type="text" name="comment_ru" class="form-control" placeholder="Введите свой комментарий" value="{{ $container->comment_ru }}" required>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Komentariýaňyzy ýazyň</label>
                                    <input type="text" name="comment_tk" class="form-control" placeholder="Komentariýaňyzy ýazyň" value="{{ $container->comment_tk }}" required>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="float: right;">Изменить</button>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>

            <button type="button" class="btn btn-custom mt-3" data-toggle="modal" data-target="#addbaggage">
                Добавить груз
            </button>

            <div class="col-12 mt-5">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Краткое наименование груза</th>
                        <th scope="col">Türkmençe</th>
                        <th scope="col">Трек № груза</th>
                        <th scope="col">Вес</th>
                        <th scope="col">Мест</th>
                        <th scope="col">Объем (куб)</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($container->cargos as $cargo)
                        <tr>
                            <td>{{ $cargo->title_ru }}</td>
                            <td>{{ $cargo->title_tk }}</td>
                            <td>{{ $cargo->track_number }}</td>
                            <td>{{ $cargo->weight }}</td>
                            <td>{{ $cargo->place }}</td>
                            <td>{{ $cargo->capacity }}</td>
                            <td style="white-space: nowrap">
                                <form action="{{ route('admin.cargo.destroy', $cargo->id) }}" method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"  id="poz-buton-{{$cargo->id}}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </form>

                                <a style="padding: 0 10px;" class="btn btn-custom hover_disable" href="{{route('admin.cargo.edit', $cargo->id)}}">
                                    <svg width="15px" height="15px" viewBox="0 -0.5 21 21" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Dribbble-Light-Preview" transform="translate(-99.000000, -400.000000)"
                                               fill="#000000">
                                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                                    <path d="M61.9,258.010643 L45.1,258.010643 L45.1,242.095788 L53.5,242.095788 L53.5,240.106431 L43,240.106431 L43,260 L64,260 L64,250.053215 L61.9,250.053215 L61.9,258.010643 Z M49.3,249.949769 L59.63095,240 L64,244.114985 L53.3341,254.031929 L49.3,254.031929 L49.3,249.949769 Z"
                                                          id="edit-[#1479]"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>

                                <span style="white-space: nowrap">
                                <input class="cargo_input" type="hidden" value="{{ $cargo->id }}">
                                <select style="width: 200px" class="code_select">
                                        <option></option>
                                        <option value="0">Deselect</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($cargo->user_id === $user->id) selected @endif>{{$user->firstname}}-{{$user->code}}</option>
                                    @endforeach
                                </select>
                            </span>
                            </td>
                        <tr>
                    @empty
                        <tr>Empty</tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th scope="col"></th><th scope="col"></th><th scope="col"></th>
                        <th scope="col"> {{ $container->cargos()->pluck('weight')->sum() }} кг</th>
                        <th scope="col"> {{ $container->cargos()->pluck('place')->sum() }}</th>
                        <th scope="col">{{ $container->cargos()->pluck('capacity')->sum() }}<sup>3</sup>
                    </tr>
                    </tfoot>
                </table>
            </div>


        </div>
    </main>
@endsection
@push('scripts')
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("[id^='poz-buton-']").each(function () {
                var id = $(this).attr('id');
                id = id.replace("poz-buton-", '');
                $('#poz-buton-' + id).on('click', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Удалить?",
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: '#0CC27E',
                        cancelButtonColor: '#FF586B',
                        confirmButtonText: 'Да, удалить!',
                        cancelButtonText: 'Нет!',
                        confirmButtonClass: 'btn btn-success ml-1',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#poz-buton-' + id).parent().submit();
                        } else {
                            Swal.fire(
                                'Cancelled',
                                'Goýbolsun edildi',
                                'error'
                            )
                        }
                    })
                });
            });

                $('.code_select').select2({
                    placeholder: "Please select a code"
                });

                $('.code_select').on('select2:select', function (e) {
                    const id = e.params.data.id;
                    const cargo_id = $(this).parent().find('.cargo_input').val();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('update_cargo') }}",
                        data: {
                            "user_id": id,
                            "cargo_id": cargo_id
                        },
                        success: function (data) {
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                });


        });

    </script>
@endpush
