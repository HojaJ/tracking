@extends('layouts.cargo-layout')
@section('content')
    @php
    $in_arhive = false;
    if(isset($cargo->container)) {
         if ($cargo->container->in_arhive === "1") {
            $in_arhive = true;
        }
    }
    @endphp

    <main class="mt-5" style="max-width: 400px; margin: 80px auto;">

        <div class="point-container ">
            <div class="point">
                <div class="point1">
                    <span>@lang('main.send_way')<br/>{{ $in_arhive ? $cargo->container->shipping->{'name_'.app()->getLocale()} : __('main.not_info') }}</span>
                    <h6>@lang('main.china')</h6>
                </div>
                <div class="point2">
                    <span>@lang('main.deliver_date')<br/>{{ $in_arhive ? $cargo->container->departure_date : __('main.not_info') }}</span>
                    <h6>@lang('main.turkmenistan')</h6>
                </div>
                <img class="img-chart" src="{{ asset('image/chart.png') }}" alt="Chart ">
            </div>
        </div>
        <div class="info mb-5">
            <div class="item d-flex align-items-center justify-content-start mt-4" @if(!$in_arhive) style="background-color: #fff" @endif >
                <div>
                    @if($in_arhive) 
                    <img src="{{ asset('image/gray-wheelbarrow.png') }}" alt="Wheelbarrow">
                    @else
                    <img src="{{ asset('image/wheelbarrow.png') }}" alt="Wheelbarrow">
                    @endif
                </div>
                <div class="pl-4 clearfix">
                    <h6>@lang('main.in_ammar') <span>{{ $cargo->created_at }}</span></h6>
                    <p class="mb-0 font-gray">@lang('main.ready_to_sent')</p>
                </div>
            </div>
            @if($in_arhive)
            <div class="item d-flex align-items-center justify-content-start mt-4" style="background-color: #fff">
                <div>
                    <img src="{{ asset('image/truck.png') }}" alt="Wheelbarrow">
                </div>
                <div class="pl-4">
                    <h6>@lang('main.sent')</h6>
                    <p class="mb-0 font-gray">@lang('main.sent_to')</p>
                </div>
            </div>
            @else
            <div class="item d-flex align-items-center justify-content-start mt-4">
                <div>
                    <img src="{{ asset('image/gray-truck.png') }}" alt="Wheelbarrow">
                </div>
                <div class="pl-4">
                    <h6>@lang('main.sent')</h6>
                    <p class="mb-0 font-gray">@lang('main.sent_to')</p>
                </div>
            </div>
            @endif
        </div>
        <ul class='info-list'>
            <li>@lang('main.cargo_name') <span> {{ $cargo->{'title_'.app()->getLocale()} }}</span></li>
            @if($in_arhive)
                <li>@lang('main.bellik') <span>{{ $cargo->container->{'comment_'.app()->getLocale()} }}</span></li>
            @else
                <li>@lang('main.bellik') <span>@lang('main.cargo_location_info', ['name' => $cargo->storage->name]) </span></li>
            @endif
            <li>@lang('main.barcode') <span>{{ $cargo->barcode }}</span></li>
            <li>@lang('main.weight_info') <span>{{ $cargo->weight }}@lang('main.kg')</span></li>
            <li>@lang('main.place_info') <span>{{ $cargo->place }}</span></li>
            <li>@lang('main.capacity_info') <span>{{ $cargo->capacity }}<sup>3</sup></span></li>
        </ul>
    </main>
@endsection

