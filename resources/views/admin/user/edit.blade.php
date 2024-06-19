@extends('layouts.admin')

@section('content')
    <main class="mt-lg-5 mt-3">
        <div class="container pos-re">

            <form action="{{route('admin.users.update', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="{{ __('Name') }}" value="{{ $user->firstname }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Surname') }}</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="{{ __('Surname') }}" value="{{ $user->lastname }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Phone') }}</label>
                                    <input type="text" name="phone" class="form-control" placeholder="{{ __('Phone') }}" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Password') }}</label>
                                    <input type="text" name="password" class="form-control" placeholder="{{ __('Password') }}" value="{{ $user->parol }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Code') }}</label>
                                    <input type="text" name="code" class="form-control" placeholder="{{ __('Code') }}" value="{{ $user->code }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Type') }}</label>
                                    <select class="form-control" name="type">
                                        <option @if($user->is_permission === 2) selected @endif value="2">{{ __('User') }}</option>
                                        <option  @if($user->is_permission === 1) selected @endif value="1">{{ __('Admin') }}</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="float: right;">{{ __('Edit') }}</button>
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
