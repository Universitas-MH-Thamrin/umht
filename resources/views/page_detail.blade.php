@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    {{-- <div class="common-hero">
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
    </div> --}}

    @php
        $heroImageUrl = $hero_img ? asset(\Illuminate\Support\Facades\Storage::url($hero_img)) : asset(\Illuminate\Support\Facades\Storage::url('public/img/img-1920x640.png'));
    @endphp
    <div
        class="common-hero position-relative text-white"
        style="background: url('{{ $heroImageUrl }}') center center / cover no-repeat; min-height: 500px;">

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgb(37, 100, 235), transparent, transparent);"></div>

        <div class="position-relative container text-center px-4 d-flex flex-column justify-content-center align-items-center" style="min-height: 100%; padding-top: 150px">
            <h1 class="fw-bold mb-3" style="font-size: 2.5rem;">{{ $data->nama }}</h1>
            <div class="d-flex justify-content-center align-items-center gap-2 small" style="color: rgba(255,255,255,0.85);">
                <a href="{{ route('front.index') }}" class="text-white text-decoration-underline">Home</a>
                <span>&gt; Halaman &gt;</span>
                <span>{{ $data->nama }}</span>
            </div>
        </div>
    </div>

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
