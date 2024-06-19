@extends('layouts.admin')
@push('css')
<link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
@endpush
@section('content')
    <main class="mt-lg-5 mt-3">
        <div class="container pos-re">
            <a style="float: right;" class="btn btn-primary" href="{{ route('admin.users.create') }}">{{ __('Add User') }}</a>
            <table id="example-user" class="display pt-lg-5 pt-2" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Surname') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Password') }}</th>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->is_permission == 1 ? __('Admin') : __('User') }}</td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->parol }}</td>
                        <td>{{ $user->code }}</td>
                        <td style="white-space: nowrap">
                            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-info btn-sm text-white">
                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                  class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"  id="poz-buton-{{$user->id}}">
                                    <i class="fas fa-trash"></i> {{ __('Delete') }}
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