@extends('layouts.app')
@section('content')
<main class="text-center" style="max-width: 600px; margin: 50px auto;">
    <h4 class="main-title my-5 text-left">@lang('main.wellcome')</h4>
    <div class="mt-5 mb-4">
        <a href="{{ route('login') }}" class="btn btn-custom btn-login text-white">@lang('main.wellcome_login')</a>
    </div>
    <div class="my-4">
        <a href="{{ route('register') }}" class="btn btn-custom btn-dashed">@lang('main.wellcome_register')</a>
    </div>
</main>

@endsection