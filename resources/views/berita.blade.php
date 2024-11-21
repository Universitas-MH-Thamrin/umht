@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    <div class="common-hero">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-8 m-auto">
                    <div class="main-heading">
                        <h1>{{ $title }}</h1>
                        <div class="space16"></div>
                        <span class="span"><img src="assets/img/icons/span1.png" alt=""> <a href="{{ route('front.index') }}">Home</a>
                            <i class="fa-regular fa-angle-right"></i></span> {{ $title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====BLOG AREA START=======-->

    <div class="blog sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="heading1">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                src="{{ asset('img/fav.png') }}" alt="" style="width: 20px;"> Informasi & Berita</span>
                        <h2 class="title tg-element-title">Berita Terbaru</h2>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
            <div class="row">
                @foreach ($beritas as $item)
                    <div class="col-lg-4">
                        <div class="blog-box" data-aos="zoom-in-up" data-aos-duration="1100">
                            <div class="image image-anime">
                                <img src="{{ $item->thumbnail ? url(Storage::url($item->thumbnail)) : asset('img/img-placeholder.webp') }}" alt="" style="height: 300px;object-fit: cover;">
                            </div>
                            <div class="heading">
                                <div class="tags">
                                    <a href="#"><img src="{{ asset('techxen') }}/assets/img/icons/blog-icon1.png"
                                            alt=""> {{ $item->user->name }}</a>
                                    <a href="#"><img src="{{ asset('techxen') }}/assets/img/icons/blog-icon2.png"
                                            alt="">
                                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->format('d') }} {{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->format('M, Y') }}</span></a>
                                </div>
                                <h4><a href="{{ route('berita.detail', $item->slug) }}">{{ Str::limit($item->judul, 40) }}.</a></h4>
                                <a href="{{ route('berita.detail', $item->slug) }}" class="learn"> Selengkapnya <span><i
                                            class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="pagination-area">
                {{ $beritas->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!--=====BLOG AREA END=======-->
@endsection
