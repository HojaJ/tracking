@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <style>
        .hover_disable:hover {
            border: 3px solid var(--blue-color) !important;
        }
    </style>
@endpush
@section('content')
    <main class="mt-lg-5 mt-3">
        <div class="container pos-re">
            <div class="dropdown cta">
                <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    {{ __('Select action') }}
                </button>
                <div class="dropdown-menu btn-custom btn-custom-dropdown" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item dropdown-submenu">
                        <a data-target="#" data-toggle="dropdown" class="dropdown-toggle ">{{ __('Send to container No.') }}</a>
                        <ul class="dropdown-menu btn-custom">
                            @foreach ( $storage->notInArhiveContainers as $container )
                                <li class="dropdown-item">
                                    <a data-target="#" class="sendToContainer"
                                       data-id="{{ $container->id }}">{{ $container->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </button>

                    <button class="dropdown-item" id="delete_rows" type="button">{{ __('Delete') }}</button>
                </div>
            </div>
            <div class="add-btns">
                <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#addcontainer">
                    {{ __('Create container') }}
                </button>
                <button type="button" class="btn btn-custom ml-3" data-toggle="modal" data-target="#addbaggage">
                    {{ __('Add cargo') }}
                </button>
            </div>

            <table id="example" class="display pt-lg-5 pt-2" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>{{ __('id') }}</th>
                    <th>{{ __('Title (RU)') }}</th>
                    <th>{{ __('Title (TM)') }}</th>
                    <th>{{ __('Title (EN)') }}</th>
                    <th>{{ __('Track No. of the cargo') }}</th>
                    <th>{{ __('Barcode') }}</th>
                    <th>{{ __('Weight (kg)') }}</th>
                    <th>{{ __('Places') }}</th>
                    <th>{{ __('Volume (cub)') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $storage->available_cargos as $cargo )
                    <tr>
                        <td></td>
                        <td>{{ $cargo->id }}</td>
                        <td>{{ $cargo->title_ru }}</td>
                        <td>{{ $cargo->title_tk }}</td>
                        <td>{{ $cargo->title_en }}</td>
                        <td>{{ $cargo->track_number }}</td>
                        <td>{{ $cargo->barcode }}</td>
                        <td>{{ $cargo->weight }}</td>
                        <td>{{ $cargo->place }}</td>
                        <td>{{ $cargo->capacity }}</td>
                        <td style="white-space: nowrap">
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



                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th style="visibility: hidden"></th>
                    <th>id</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>{{ __('Weight (kg)') }}</th>
                    <th>{{ __('Places') }}</th>
                    <th>{{ __('Volume (cub)') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </main>

    <!-- Modals -->
    <div class="modal fade" id="addcontainer" tabindex="-1" aria-labelledby="addcontainerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="addcontainerLabel">{{ __('Enter the required information to create a container') }}</h6>
                </div>
                <form action="{{ route('admin.container.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="storage_id" value="{{$storage->id}}">
                    <div class="modal-body">
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="{{ __('Container number') }}" name="name" required/>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="{{ __("Note (RU)") }}" name="comment_ru"
                                   required/>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="{{ __("Note (TM)") }}" name="comment_tk"
                                   required/>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="{{ __("Note (EN)") }}" name="comment_en"
                                   required/>
                        </div>
                    </div>
                    <div class="modal-footer">
{{--                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Cancel') }}</button>--}}
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addbaggage" tabindex="-1" aria-labelledby="addbaggageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="addbaggageLabel">Введите нужную информацию для создания груза</h6>
                </div>
                <form action="{{ route('admin.cargo.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="storage_id" value="{{$storage->id}}">
                    <div class="modal-body">
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="{{ __('Title (RU)') }}" name='title_ru' required/>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="{{ __('Title (TM)') }}" name='title_tk' required/>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="{{ __('Title (EN)') }}" name='title_en' required/>
                        </div>
                        <div class="mb-2">
                            <input type="number" class="form-control" placeholder="{{ __('Track number') }}" name="track_number" required/>
                        </div>
                        <div class="mb-2">
                            <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                   type="text" class="form-control" placeholder="{{ __('Barcode') }}" name="barcode"/>
                        </div>
                        <div class="mb-2">
                            <input type="number" step="any" class="form-control" placeholder="{{ __('Weight') }}" name="weight"
                                   required/>
                        </div>
                        <div class="mb-2">
                            <input type="number" step="any" class="form-control" placeholder="{{ __('Places') }}" name="place"
                                   required/>
                        </div>
                        <div class="mb-2">
                            <input type="number" step="any" class="form-control" placeholder="{{ __('Volume') }}" name="capacity"
                                   required/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let example = $('#example').DataTable({
                "pageLength": 'All',
                "bPaginate": false,
                "ordering": false,
                "bLengthChange": false,
                "bFilter": true,
                'sorting': false,
                "bAutoWidth": false,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Поиск"
                },
                "infoCallback": function (settings, start, end, max, total, pre) {
                    return 'Итоговая строка: ' + total;
                },

                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
                    weight_total = api.column(6).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    place_total = api.column(7).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    capacity_total = api.column(8).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // Update footer
                    $(api.column(6).footer()).html(
                        'Вес: ' + weight_total + 'кг'
                    );
                    $(api.column(7).footer()).html(
                        'Мест: ' + place_total
                    );
                    $(api.column(8).footer()).html(
                        'Объем: ' + capacity_total.toFixed(2) + '<sup>3</sup>'
                    );
                },

                columnDefs: [
                    {
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                    {
                        visible: false,
                        searchable: false,
                        targets: 1,
                    },
                    {
                        width: 200,
                        targets: 2,
                    },
                    {
                        width: 200,
                        targets: 3,
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ]
            });

            $('#example tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
                console.log();
            });

            $('#delete_rows').on('click', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: "Удалить?",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Да, Удалить!',
                    cancelButtonText: 'Нет!',
                    confirmButtonClass: 'btn btn-success ml-1',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {

                        deleterows();
                    } else {
                        Swal.fire(
                            'Cancelled',
                            'error'
                        )
                    }
                })
            });

            function deleterows() {
                var rowdata = example.rows('.selected').data();
                var array = [];
                for (var i = 0; i < rowdata.length; i++) {
                    array.push(rowdata[i][1]);
                }
                var data = {
                    data: array
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.cargo.delete') }}",
                    data: data,

                    success: function (data) {
                        if (data == 'Success') {
                            location.reload();
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            };


            $('#excel').click(function (e) {
                var rowdata = example.rows('.selected').data();
                var array = [];
                for (var i = 0; i < rowdata.length; i++) {
                    array.push(rowdata[i][1]);
                }
                var data = {
                    data: array
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                $.ajax({
                    xhrFields: {
                        responseType: 'blob',
                    },
                    type: "GET",
                    url: "{{ route('admin.cargo.excel') }}",
                    data: data,

                    success: function (result, status, xhr) {
                        var filename = 'gruz.xlsx';
                        // The actual download
                        var blob = new Blob([result], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;

                        document.body.appendChild(link);

                        link.click();
                        document.body.removeChild(link);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            });

            $('.sendToContainer').click(function (e) {
                e.preventDefault();
                var container_id = $(this).data('id');

                var rowdata = example.rows('.selected').data();
                var array = [];
                for (var i = 0; i < rowdata.length; i++) {
                    array.push(rowdata[i][1]);
                }

                var data = {
                    container_id: container_id,
                    data: array,
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.cargo.container') }}",
                    data: data,
                    success: function (data) {
                        console.log(data);
                        if (data == 'Success') {
                            location.reload();
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            example.on("click", "th.select-checkbox", function () {
                if ($("th.select-checkbox").hasClass("selected")) {
                    example.rows().deselect();
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    example.rows().select();
                    $("th.select-checkbox").addClass("selected");
                }
            })
                .on("select deselect", function () {
                    if (example.rows({selected: true}).count() !== example.rows().count()) {
                        $("th.select-checkbox").removeClass("selected");
                    } else {
                        $("th.select-checkbox").addClass("selected");
                    }
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
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

        });
    </script>
@endpush