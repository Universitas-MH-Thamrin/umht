@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    <div class="common-hero">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-8 m-auto">
                    <div class="main-heading">
                        <h1>{{ $data->nama }}</h1>
                        <div class="space16"></div>
                        <span class="span"><img src="assets/img/icons/span1.png" alt=""> <a href="{{ route('front.index') }}">Home</a>
                            <i class="fa-regular fa-angle-right"></i></span> Halaman</span>
                            <i class="fa-regular fa-angle-right"></i></span> {{ $data->nama }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====HERO AREA END=======-->

    <section class="hero10-benar">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="marquee-wrap marquee-wrap-inner">
                        <div class="marquee-text">
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                            <div class="brand-single-box">
                                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-after"></div>
        </div>
    </section>

    <!--=====SERVICE DETAILS AREA START=======-->

    <div class="service-details-area-all sp">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 m-auto">
                    <div class="service-details-post">
                        <article>
                            <div class="details-post-area">
                                <div class="heading1">
                                    <h2>{{ $data->nama }}</h2>
                                    <div class="space16"></div>
                                    {!! $data->konten !!}
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====SERVICE DETAILS AREA END=======-->

@endsection
