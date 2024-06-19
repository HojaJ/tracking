@extends('layouts.admin')
@push('css')
<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
@endpush
@section('content')
    <main class="mt-lg-5 mt-3"> 
        <div class="container pos-re">      
            <a style="float: right;" class="btn btn-primary" href="{{ route('admin.shipping.create') }}">{{ __("Add") }}</a>
            <table id="example-user" class="display pt-lg-5 pt-2" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>{{ __('Title (RU)') }}</th>
                        <th>{{ __('Title (TM)') }}</th>
                        <th>{{ __('Title (En)') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shippings as $shipping)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $shipping->name_ru }}</td>
                        <td>{{ $shipping->name_tk }}</td>
                        <td>{{ $shipping->name_en }}</td>
                        <td>
                            <a href="{{route('admin.shipping.edit', $shipping->id)}}" class="btn btn-info btn-sm text-white">
                                <i class="fas fa-edit"></i> {{__('Edit')}}
                            </a>

                            <form action="{{ route('admin.shipping.destroy', $shipping->id) }}" method="POST"
                              class="d-inline-block">
                              @csrf
                              @method('DELETE')
                              <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"  id="poz-buton-{{$shipping->id}}">
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
@endsection
@push('scripts')
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script>
$(function() {
    $("[id^='poz-buton-']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("poz-buton-",'');
        $('#poz-buton-'+id).on('click', function(event){
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

    $('#example-user').DataTable({
        "pageLength": 'All',
        "bPaginate": false,
        "ordering": false,
        "bLengthChange": false,
        "bFilter": true,
        'sorting': false,
        "bInfo": false,
        "bAutoWidth": false,
        language: {
            url: '{{ asset('js/'. app()->getLocale() .'.json') }}',
        },
    });
});

</script>
@endpush