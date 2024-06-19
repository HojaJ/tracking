@extends('layouts.app')
@section('content')
<main class="text-center" style="max-width: 400px; margin: 80px auto">
    <h4 class="main-title mt-5 text-left">@lang('main.enter_info')</h4>
    <form class="mt-5 login_form" method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="input-group mb-3">
            <div class="input-group-prepend" style="display: flex; align-items: center; margin-right: 10px;">
              <span class="input-group-text" id="basic-addon1">+993</span>
            </div>
            <input type="number" minlength="8" maxlength="8" class="form-control @error('phone') is-invalid @enderror" placeholder="@lang('main.phone_input')" name="phone" aria-describedby="basic-addon1" autofocus>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('main.password_input')" name="password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mt-5 mb-4">
            <button href="" class="btn btn-custom btn-login text-white">@lang('main.wellcome_login')</button>
        </div>
    </form>
    <a style="color: black" href="{{ route('register') }}" class="text-secondary">@lang('main.wellcome_register')</a>
    
</main>
@endsection