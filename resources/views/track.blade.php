@extends('layouts.app')
@section('content')
<main>

    <div class="slider-area ">
        <div class="slider-active">

            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 col-lg-9">
                            <div class="hero__caption">
                                <h1>{{ __('Safe & Reliable Logistic Solutions!') }}</h1>
                            </div>

                            <div class="search-box">

                                <div class="search-form">
                                    <a href="{{ route('login') }}">{{ __('Track') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="our-info-area pt-70 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-info mb-30">
                        <div class="info-icon">
                            <span class="flaticon-support"></span>
                        </div>
                        <div class="info-caption">
                            <p>{{ __('Call Us Anytime') }}</p>
                            <span>+9936555555</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-info mb-30">
                        <div class="info-icon">
                            <span class="flaticon-clock"></span>
                        </div>
                        <div class="info-caption">
                            <p>{{ __('Sunday CLOSED') }}</p>
                            <span>8.00 - 18.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-info mb-30">
                        <div class="info-icon">
                            <span class="flaticon-place"></span>
                        </div>
                        <div class="info-caption">
                            <p>Ankara street</p>
                            <span>Ashgabat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="categories-area section-padding30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="section-tittle text-center mb-80">
                        <span>{{ __('Our Services') }}</span>
                        <h2>{{ __('What We Can Do For You') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-cat text-center mb-50">
                        <div class="cat-icon">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="cat-cap">
                            <h5><a href="javascript:void(0)">{{ __('Land Transport') }}</a></h5>
                            <p>{{ __('The sea freight service has grown considerably in recent years. We spend timetting to know your processes to.') }}</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-cat text-center mb-50">
                        <div class="cat-icon">
                            <span class="flaticon-ship"></span>
                        </div>
                        <div class="cat-cap">
                            <h5><a href="javascript:void(0)">{{ __('Ship Transport') }}</a></h5>
                            <p>{{ __('The sea freight service has grown considerably in recent years. We spend timetting to know your processes to.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-cat text-center mb-50">
                        <div class="cat-icon">
                            <span class="flaticon-plane"></span>
                        </div>
                        <div class="cat-cap">
                            <h5><a href="javascript:void(0)">{{ __('Air Transport') }}</a></h5>
                            <p>{{ __('The sea freight service has grown considerably in recent years. We spend timetting to know your processes to.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="about-low-area padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-caption mb-50">

                        <div class="section-tittle mb-35">
                            <span>{{__('About Our Company')}}</span>
                            <h2>{{ __('Safe Logistic & Transport Solutions That Saves our Valuable Time!') }}</h2>
                        </div>
                        <p>{{ __('Brook presents your services with flexible, convenient and cdpose layouts. You can select your favorite layouts & elements for cular ts with unlimited ustomization possibilities. Pixel-perfect replication of the designers is intended.') }}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">

                    <div class="about-img ">
                        <div class="about-font-img">
                            <img src="{{ asset('home/images/about2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="home-blog-area section-padding30">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center mb-70">
                        <span>{{ __('Our Recent news') }}</span>
                        <h2>{{ __('Tourist Blog') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="{{ asset('home/images/blog01.png') }}" alt="">
                            </div>
                        </div>
                        <div class="blog-caption">
                            <div class="blog-date text-center">
                                <span>27</span>
                                <p>SEP</p>
                            </div>
                            <div class="blog-cap">
                                <ul>
                                    <li><a href="#"><i class="ti-user"></i> Jessica Temphers</a></li>
                                    <li><a href="#"><i class="ti-comment-alt"></i> 12</a></li>
                                </ul>
                                <h3><a href="javascript:void(0)">{{ __("Here’s what you should know before.") }}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="{{ asset('home/images/blog1.png') }}" alt="">
                            </div>
                        </div>
                        <div class="blog-caption">
                            <div class="blog-date text-center">
                                <span>27</span>
                                <p>SEP</p>
                            </div>
                            <div class="blog-cap">
                                <ul>
                                    <li><a href="#"><i class="ti-user"></i> Jessica Temphers</a></li>
                                    <li><a href="#"><i class="ti-comment-alt"></i> 12</a></li>
                                </ul>
                                <h3><a href="javascript:void(0)">{{ __("Here’s what you should know before.") }}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="{{ asset('home/images/blog02.png') }}" alt="">
                            </div>
                        </div>
                        <div class="blog-caption">
                            <div class="blog-date text-center">
                                <span>27</span>
                                <p>SEP</p>
                            </div>
                            <div class="blog-cap">
                                <ul>
                                    <li><a href="#"><i class="ti-user"></i> Jessica Temphers</a></li>
                                    <li><a href="#"><i class="ti-comment-alt"></i> 12</a></li>
                                </ul>
                                <h3><a href="javascript:void(0)">{{ __("Here’s what you should know before.") }}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection