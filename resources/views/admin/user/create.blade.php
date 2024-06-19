@extends('layouts.admin')

@section('content')
    <main class="mt-lg-5 mt-3">
        <div class="container pos-re">

            <form action="{{route('admin.users.store')}}" method="POST">
                @csrf
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="{{ __('Name') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Surname') }}</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="{{ __('Surname') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Phone') }}</label>
                                    <input type="text" name="phone" class="form-control" placeholder="{{ __('Phone') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Password') }}</label>
                                    <input type="text" name="password" class="form-control" placeholder="{{ __('Password') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Code') }}</label>
                                    <input type="text" name="code" class="form-control" placeholder="{{ __('Code') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Type') }}</label>
                                    <select class="form-control" name="type">
                                        <option value="2">{{ __('User') }}</option>
                                        <option value="1">{{ __('Admin') }}</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit"  class="btn btn-primary" style="float: right;">{{ __('Add') }}</button>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>

        </div>
    </main>
@endsection