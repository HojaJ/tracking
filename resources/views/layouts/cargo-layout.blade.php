<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tracking App </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>

    <div class="header-area">
        <div class="main-header ">
            <div class="header-top d-none d-lg-block">
                <div class="container">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>
                                    <li>@lang('main.phone_input'): +99365555555</li>
                                    <li>{{ __('Email') }}: email@gmail.com</li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-social">
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom  header-sticky">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="/"><img src="{{ asset('home/images/logo.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper  d-flex align-items-center justify-content-end">

                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation" style="display: flex; justify-content: center; align-items: center">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/">Contact</a></li>
                                            <div class="d-flex">
                                                <div class="dropdown">
                                                    <button style="cursor:pointer; background: transparent;outline: none;border: none;" class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="{{asset('image/lang.png')}}" alt="Language Swithcer">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        @if(Request::is('ru') || Request::is('ru/*'))
                                                            <a href="{{ LaravelLocalization::getLocalizedURL('tk', null, [], true) }}">
                                                                <button class="dropdown-item" type="button">TM</button>
                                                            </a>
                                                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                                                <button class="dropdown-item" type="button">EN</button>
                                                            </a>
                                                        @elseif(Request::is('en') || Request::is('en/*'))
                                                            <a href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}">
                                                                <button class="dropdown-item" type="button">RU</button>
                                                            </a>
                                                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                                                <button class="dropdown-item" type="button">EN</button>
                                                            </a>
                                                        @else
                                                            <a href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}">
                                                                <button class="dropdown-item" type="button">RU</button>
                                                            </a>
                                                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                                                <button class="dropdown-item" type="button">EN</button>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (Auth::check())
                                                    &nbsp;&nbsp;
                                                    <div>
                                                        <form action="{{  \LaravelLocalization::localizeURL('/logout') }} " method="POST">
                                                            @csrf
                                                            <button style="background: transparent;color:white;border: none;">{{ __('Logout') }}</button>
                                                        </form>
                                                    </div>
                                                @else
                                                    &nbsp;
                                                    <a href="{{ route('login') }}">@lang('main.wellcome_login')</a>
                                                @endif
                                            </div>
                                        </ul>

                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>


@yield('content')

<footer>

    <div class="footer-area footer-bg">
        <div class="container">
            <div class="footer-top footer-padding">

                <div class="footer-heading">
                    <div class="row justify-content-between">
                        <div class="col-xl-6 col-lg-8 col-md-8">
                            <div class="wantToWork-caption wantToWork-caption2">
                                <h2>{{ __('We Understand The Importance Approaching Each Work!') }}</h2>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <span class="contact-number f-right">+99365555555</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12">
                        <div class="footer-copy-right text-center">
                            <p>
                                Copyright ©
                                2024 {{__('All rights reserved')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>

<div id="back-top">
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<script src="{{ asset('home/js/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('home/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('home/js/slick.min.js') }}"></script>
<script src="{{ asset('home/js/wow.min.js') }}"></script>
<script src="{{ asset('home/js/animated.headline.js') }}"></script>
<script src="{{ asset('home/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('home/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('home/js/contact.js') }}"></script>
<script src="{{ asset('home/js/jquery.form.js') }}"></script>
<script src="{{ asset('home/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('home/js/mail-script.js') }}"></script>
<script src="{{ asset('home/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('home/js/plugins.js') }}"></script>
<script src="{{ asset('home/js/main.js') }}"></script>
@stack('scripts')

</body>
</html>