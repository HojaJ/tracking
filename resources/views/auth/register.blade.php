@extends('layouts.app')
@section('content')
<main class="text-center" style="max-width: 400px; margin: 80px auto;">
    <h4 class="main-title mt-5 text-left">@lang('main.enter_info_new_acc')</h4>
    <form class="mt-5 login_form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" placeholder="@lang('main.firstname')" name="firstname" required />
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="@lang('main.lastname')" name="lastname" required />
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend" style="display: flex; align-items: center; margin-right: 10px;">
                <span class="input-group-text" id="basic-addon1" >+993</span>
              </div>
            <input type="number" minlength="8" maxlength="8" class="form-control @error('phone') is-invalid @enderror" aria-describedby="basic-addon1" placeholder="@lang('main.phone_input')" name="phone" required />
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group">
            <input type="password" class="form-control" placeholder="@lang('main.password_input')" name="password" required />
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mt-5 mb-4">
            <button class="btn btn-custom btn-login text-white">@lang('main.wellcome_register')</button>
        </div>
    </form>
    <a style="color: black" href="{{route('login')}}" class="text-secondary">@lang('main.wellcome_login')</a>
</main>

@endsection