@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">

    <style>
        .hover_disable:hover{
            border: 1px solid transparent;
        }
        @media (min-width: 1200px){
            .custom-container {
                max-width: 1300px;
            }
            }


    </style>
@endpush
@section('content')
    <main class="mt-lg-5 mt-3">
        <div class="container custom-container pos-re">
          <div class="dropdown cta">
            <button class="btn btn-custom dropdown-toggle" type="button" id ="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Выберите действие
            </button>
            <div class="dropdown-menu btn-custom btn-custom-dropdown" aria-labelledby="dropdownMenu2">
              <button class="dropdown-item" id="excel" type="button">Сохранить как Excell</button>
              <button class="dropdown-item" id="delete_rows" type="button" >Удалить</button>
            </div>
          </div>
            <table id="example-user" class="display pt-lg-5 pt-2" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>{{ __('id') }}</th>
                    <th>{{ __('Detailed') }}</th>
                    <th></th>
                    <th>{{ __('Container No.') }}</th>
                    <th>{{ __('Created in which warehouse') }}</th>
                    <th>{{ __('Transportation') }}</th>
                    <th>{{ __('Date of dispatch') }}</th>
                    <th>{{ __('Note') }}</th>
                    <th>{{ __('Note in Turkmen') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($containers as $container)
                @if(isset($container->cargos))
                @php
                $sum['weight'] = [];
                $sum['place'] = [];
                $sum['capacity'] = [];

                $array = [];
                    foreach ($container->cargos as $cargo) {



                      $obj = (object) [
                        'title_ru' => $cargo->title_ru,
                        'title_tk' => $cargo->title_tk,
                        'truck_number' => $cargo->track_number,
                        'barcode' => $cargo->barcode ? $cargo->barcode : '',
                        'weight' => floatval($cargo->weight),
                        'place' => floatval($cargo->place),
                        'capacity' => floatval($cargo->capacity),

                    ];
                      array_push($sum['weight'], floatval($cargo->weight));
                      array_push($sum['place'], floatval($cargo->place));
                      array_push($sum['capacity'], floatval($cargo->capacity));
                      array_push($array, $obj);
                    }
                    $sum['place'] =  number_format(array_sum($sum['place']),2);
                    $sum['capacity'] = intval(array_sum($sum['capacity']));
                    $sum['weight'] = number_format(array_sum($sum['weight']),2);

                    $lastObj = (object) [
                      'cargos' => $array,
                      'sum_place' => $sum['place'],
                      'sum_capacity' => $sum['capacity'],
                      'sum_weight' => $sum['weight']
                  ];
                    $title_search = collect($array)->implode('title_ru',',');
                    $title_search .= collect($array)->implode('title_tk',',');
                    $title_search .= collect($array)->implode('truck_number',',');
                    $title_search .= collect($array)->implode('barcode',',');

                @endphp
                    @endif
                    <tr data-child-value="{{json_encode($lastObj) }}">
                        <td></td>
                        <td>{{ $container->id }}</td>

                        <td class="details-control"></td>
                        <td>{{ $title_search }}</td>
                        <td>{{ $container->name ?: 'empty' }}</td>
                        <td>{{ $container->storage->name ?: 'empty'  }}</td>
                        <td>{{ isset($container->shipping->{'name_'.app()->getLocale()}) ? $container->shipping->{'name_'.app()->getLocale()} : 'empty' }}</td>
                        <td>{{ $container->departure_date ?: 'empty'  }}</td>
                        <td>{{ $container->comment_ru ?: 'empty'}}</td>
                        <td>{{ $container->comment_tk ?: 'empty'}}</td>
                        <td class="d-flex">
                            <a href="{{route('admin.archive.edit', $container->id)}}" class="btn btn-info btn-sm text-white hover_disable">{{ __('Edit') }}</a>
                            <form action="{{ route('admin.container.destroy', $container->id) }}" method="POST"
                                  class="d-inline-block ml-1">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white hover_disable"  id="poz-buton-{{$container->id}}">
                                    <i class="fas fa-trash"></i> {{__('Delete')}}
                                </a>
                            </form>

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </main>

    <div class="modal fade" id="editcontainer" tabindex="-1" aria-labelledby="editcontainerLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="aeditcontainerLabel">Измените поля</h6>
        </div>
          <form method="post" class="editcontainer-form" action="{{ route('admin.container.editcon') }}">
            @csrf
            
            <input type="hidden" name="row_id" id="row_id" value="">
            <div class="modal-body">
              <div class="mb-2">
                <input type="text" name="comment_ru" class="form-control"  placeholder="{{ __('Note (RU)') }}" required />
              </div>
              <div class="mb-2">
                <input type="text" name="comment_tk" class="form-control"   placeholder="{{ __('Note (TM)') }}" required />
              </div>
                <div class="mb-2">
                    <input type="text" name="comment_en" class="form-control"   placeholder="{{ __('Note (En)') }}" required />
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Cancel')}}</button>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $("[id^='poz-buton-']").each(function() {
                var id = $(this).attr('id');
                id = id.replace("poz-buton-",'');
                $('#poz-buton-'+id).on('click', function(event){
                    event.preventDefault();
                    Swal.fire({
                        title: "Bu Useri pozmak islýäňizmi!",
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: '#0CC27E',
                        cancelButtonColor: '#FF586B',
                        confirmButtonText: 'Howwa, poz!',
                        cancelButtonText: 'Ýok!',
                        confirmButtonClass: 'btn btn-success ml-1',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#poz-buton-'+id).parent().submit();
                        } else{
                            Swal.fire(
                                'Cancelled',
                                'Goýbolsun edildi',
                                'error'
                            )}
                    })
                });
            });

           var example = $('#example-user').DataTable({
                "pageLength": 'All',
                "bPaginate": false,
                "ordering": false,
                "bLengthChange": false,
                "bFilter": true,
                'sorting': false,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Поиск"
                },
                "infoCallback": function( settings, start, end, max, total, pre ) {
                    return 'Итоговая строка: ' + total;
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
                        visible: false,
                        searchable: true,
                        targets: 3,
                    }
                  ],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    order: [
                        [1, 'asc']
                  ]
            });

            function format(value) {
      
      var array = value['cargos'];
      if (typeof array != "undefined" && array != null && array.length != null && array.length > 0) {
        var num = 1;
          var html = '<table class="table"><thead><tr><th scope="col">'+ "{{__('Title (RU)')}}" +'</th><th scope="col">'+ "{{__('Title (TM)')}}" +'</th><th scope="col">'+ "{{__('Track number')}}" +'</th><th scope="col">'+ "{{__('Barcode')}}" +'</th><th scope="col">'+ "{{__('Weight')}}" +'</th><th scope="col">'+ "{{__('Places')}}" +'</th><th scope="col">'+ "{{__('Volume (cub)')}}" +' (куб)</th><th scope="col">'+ "{{__('Actions')}}" +'</th></tr></thead><tbody>';

        array.forEach(function (element) {
          html += '<tr><td>'+ element['title_ru'] + 
          '</td><td>' + element['title_tk'] + 
          '</td><td>' + element['truck_number'] + 
          '</td><td>' + element['barcode'] +
          '</td><td>' + element['weight'] +
          '</td><td>' + element['place'] + 
          '</td><td>' + element['capacity'] +'</td><tr>';
        });
        html += '</tbody><tfoot><tr><th scope="col"></th><th scope="col"></th><th scope="col"></th><th scope="col"></th>' +
                '<th scope="col">' + value['sum_weight'] +
                'кг</th><th scope="col">' + value['sum_place'] +
                '</th><th scope="col">' + value['sum_capacity'] + '<sup>3</sup></tr></tfoot>';

        html += '</table>';
        // return '<div>Трэк Номеры грузов: ' + JSON.stringify(value['truck_number'])  + '</div><div>Вес: ' + value['weight']  + '</div><div>Мест: ' + value['place']  + '</div><div>Обьем: ' + value['capacity']  + '<sup>3</sup></div>';  
        return html;
      }else  {
        return '<div>Груз не добавлен!</div>';  
      }        
    }
            $('#example-user').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = example.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(tr.data('child-value'))).show();
                    tr.addClass('shown');
                }
            });
            $('#example-user tbody').on( 'click', 'tr', function () {
                $(this).toggleClass('selected');
            } );
            example.on("click", "th.select-checkbox", function() {
                if ($("th.select-checkbox").hasClass("selected")) {
                    example.rows().deselect();
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    example.rows().select();
                    $("th.select-checkbox").addClass("selected");
                }
            })
            .on("select deselect", function() {
                if (example.rows({selected: true}).count() !== example.rows().count()) {
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    $("th.select-checkbox").addClass("selected");
                }
            });

            $('#excel').click(function (e) {
        var rowdata = example.rows('.selected').data(); 
        var array = [];
        for (var i = 0; i < rowdata.length; i++) {
          array.push(rowdata[i][1]);
        }
        var data = {
          data: array
        }
        

        e.preventDefault();
        $.ajax({
          xhrFields: {
            responseType: 'blob',
          },
          type: "GET",
          url: "{{ route('admin.container.excel') }}",
          data: data,
          
          success: function(result, status, xhr) {
            var filename = 'container.xlsx';
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


            $("#editcontainer").on('show.bs.modal', function(e) {
                var Id = $(e.relatedTarget).data('id');
                var comment_ru = $(e.relatedTarget).data('comment_ru');
                var comment_tk = $(e.relatedTarget).data('comment_tk');
                $(e.currentTarget).find('input[name="row_id"]').val(Id);
                $(e.currentTarget).find('input[name="comment_ru"]').val(comment_ru);
                $(e.currentTarget).find('input[name="comment_tk"]').val(comment_tk);
            });


        });

    </script>
@endpush