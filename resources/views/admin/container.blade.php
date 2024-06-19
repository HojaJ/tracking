@extends('layouts.admin')
@push('css')
<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

@endpush
@section('content')
<main class="mt-lg-5 mt-3">
  <div class="container pos-re">
      <div class="dropdown cta">
          <button class="btn btn-custom dropdown-toggle" type="button" id ="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 60px;">
            Выберите действие
          </button>
          <div class="dropdown-menu btn-custom btn-custom-dropdown" aria-labelledby="dropdownMenu2">
            <button class="dropdown-item" id="delete_rows" type="button" >Удалить</button>
          </div>
        </div>
        
      <table id="example" class="display pt-lg-5 pt-2 red-colored" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th></th>
                  <th>{{ __('id') }}</th>
                  <th>{{ __('Details') }}</th>
                  <th>{{ __('Container No.') }}</th>
                  <th>{{ __('Created in which warehouse') }}</th>
                  <th>{{ __('Note (RU)') }}</th>
                  <th>{{ __('Note (TM)') }}</th>
                  <th>{{ __('Note (EN)') }}</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
            @foreach ( $containers as $container )

                @if(isset($container->cargos))
                    @php
                    $sum['weight'] = [];
                    $sum['place'] = [];
                    $sum['capacity'] = [];

                    $array = [];
                        foreach ($container->cargos as $cargo) {
                            $cargo_update = '<span style="white-space: nowrap"><input class="cargo_input" type="hidden" value="'. $cargo->id .'"><select style="width: 200px" class="code_select"><option></option><option value="0">Deselect</option>';

                            foreach($users as $user){
                               $cargo_update .=  '<option value="'.$user->id.'"'.($cargo->user_id === $user->id ? 'selected' : '' ) .'>' . $user->firstname . '-' . $user->code . '</option>';
                            }
                            $cargo_update .='</select></span>';


                          $obj = (object) [
                            'title_ru' => $cargo->title_ru,
                            'title_tk' => $cargo->title_tk,
                            'truck_number' => $cargo->track_number,
                            'barcode' => $cargo->barcode ?? '',
                            'weight' => floatval($cargo->weight),
                            'place' => floatval($cargo->place),
                            'capacity' => floatval($cargo->capacity),
                            'edit_url' => route('admin.cargo.edit', $cargo->id),
                            'cargo_update' => $cargo_update
                        ];
                          array_push($sum['weight'], floatval($cargo->weight));
                          array_push($sum['place'], floatval($cargo->place));
                          array_push($sum['capacity'], floatval($cargo->capacity));
                          array_push($array, $obj);
                        }
                        $sum['place'] = array_sum($sum['place']);
                        $sum['capacity'] = array_sum($sum['capacity']);
                        $sum['weight'] = array_sum($sum['weight']);

                        $lastObj = (object) [
                          'cargos' => $array,
                          'sum_place' => $sum['place'],
                          'sum_capacity' => $sum['capacity'],
                          'sum_weight' => $sum['weight']
                      ];
                        
                    @endphp
                @endif
            <tr data-child-value="{{json_encode($lastObj)}}">
              <td></td>
              <td>{{ $container->id }}</td>
                <td class="details-control"></td>
              <td>{{ $container->name ?: 'empty' }}</td>
              <td>{{ $container->storage->name ?: 'empty'  }}</td>
              <td>{{ $container->comment_ru ?: 'empty'}}</td>
              <td>{{ $container->comment_tk ?: 'empty'}}</td>
              <td>{{ $container->comment_en ?: 'empty'}}</td>
              <td><button data-comment_ru="{{ $container->comment_ru ?: 'Пустой'}}" data-comment_tk="{{ $container->comment_tk ?: 'Пустой'}}" data-id="{{ $container->id }}" type="button" class="btn send btn-custom" data-toggle="modal" data-target="#editcontainer">{{ __('Send') }}</button>
              </td>
            </tr>
            @endforeach          
          </tbody>
      </table>
  </div>        
</main>

<!-- Modals -->

<div class="modal fade" id="editcontainer" tabindex="-1" aria-labelledby="editcontainerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="editcontainerLabel">{{ __('Fill in the fields') }}</h6>
            </div>
            <form method="post" class="editcontainer-form" action="{{ route('admin.container.arhive') }}"">
                @csrf

                <input type="hidden" name="row_id" id="row_id" value="">
                <div class="modal-body">
                    <div class="mb-2">
                        <small>{{ __('Date of Dispatch') }}</small>
                        <input type="datetime-local" class="form-control"  name="depart_time" required />
                    </div>
                    <div class="mb-2">
                        <select name="shipping_id" class="form-control" required>
                             <option selected="true" disabled="disabled">{{ __('Select route') }}</option>
                            @if(isset($shippings))
                                @foreach ( $shippings as $shipping )
                                    <option value="{{ $shipping->id }}">{{ $shipping->name_ru }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="comment_ru" class="form-control"  placeholder="{{ __('Enter your comment') }}" required />
                    </div>
                    <div class="mb-2">
                        <input type="text" name="comment_tk" class="form-control"   placeholder="{{ __('In Turkmen') }}" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>@endsection

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
      let example = $('#example').DataTable({
        "pageLength": 'All',
        "bPaginate": false,
        "ordering": false,
        "bLengthChange": false,
        "bFilter": true,
        'sorting': false,
        "bAutoWidth": false,
          language: {
              url: '{{ asset('js/'. app()->getLocale() .'.json') }}',
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
          '</td><td>' + element['capacity'] +
          '</td><td style="white-space: nowrap">' +
              '<a style="padding: 0 10px;" class="hover_disable" href="'+ element['edit_url'] +'"><svg width="15px" height="15px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-99.000000, -400.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M61.9,258.010643 L45.1,258.010643 L45.1,242.095788 L53.5,242.095788 L53.5,240.106431 L43,240.106431 L43,260 L64,260 L64,250.053215 L61.9,250.053215 L61.9,258.010643 Z M49.3,249.949769 L59.63095,240 L64,244.114985 L53.3341,254.031929 L49.3,254.031929 L49.3,249.949769 Z" id="edit-[#1479]"></path> </g> </g> </g> </svg></a>' +
            element['cargo_update']
              + '</td><tr>';
        });
        html += '</tbody><tfoot><tr><th scope="col"></th><th scope="col"></th><th scope="col"></th><th scope="col"></th>' +
                '<th scope="col">' + value['sum_weight'] +
                'кг</th><th scope="col">' + value['sum_place'] +
                '</th><th scope="col">' + value['sum_capacity'] + '<sup>3<sup></tr></tfoot>';

        html += '</table>';
        // return '<div>Трэк Номеры грузов: ' + JSON.stringify(value['truck_number'])  + '</div><div>Вес: ' + value['weight']  + '</div><div>Мест: ' + value['place']  + '</div><div>Обьем: ' + value['capacity']  + '<sup>3</sup></div>';
        return html;
      }else  {
        return '<div>Груз не добавлен!</div>';  
      }        
    }

    $('#delete_rows').on('click', function(event){
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
                } else{
                    Swal.fire(
                    'Cancelled',
                    'error'
                )}
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
          url: "{{ route('admin.container.delete') }}",
          data: data,
          
          success: function (data) {
            if(data == 'Success') {
              location.reload();
            }
          },
          error: function (data) {
              console.log(data);
          }
        }); 
    };



    $('#example').on('click', 'td.details-control', function () {
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
            selectConfig();
        }
    });


    function selectConfig() {
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
    }

    $('#example tbody').on( 'click', 'tr', function () {
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