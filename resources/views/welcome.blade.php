@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    {{-- <div class="hero1"
        style="background-image: url({{ asset('techxen') }}/assets/img/bg/hero1-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-headding">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                src="{{ asset('img/fav.png') }}" alt=""> {{ env('APP_NAME') }}</span>
                        <h1 class="title tg-element-title">Website Resmi Universitas<span class="after"> MH. Thamrin</span>
                        </h1>
                        <div class="space16"></div>
                        <p>Bergabunglah bersama Universitas MH Thamrin untuk membangun karier cemerlang di dunia
                            profesional.</p>

                        <div class="space30"></div>
                        <div class="buttons">
                            <a class="theme-btn1" href="javascript:void(0)">PMB Universitas MH. Thamrin <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="{{ url(Storage::url($sliders->image)) }}" alt="" style="width: 100%;">
                </div>

            </div>
        </div>
    </div> --}}

    <!--=====HERO AREA START=======-->

    <div class="tp-slider-area">
        <div class="tp-slider-wrapper p-relative">
            <div class="tp-slider-arrow-box">
                <button class="slider-prev" style="background-color: #1A37AA; color:white;"><i
                        class="fa-solid fa-angle-right"></i></button>
                <button class="slider-next" style="background-color: #1A37AA; color:white;"><i
                        class="fa-solid fa-angle-left"></i></button>
            </div>
            <div class="swiper-container tp-slider-active">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $item)
                        <div class="swiper-slide">
                            <div class="tp-slider-bg d-flex justify-content-center align-items-center p-relative fix">
                                <div class="tp-slider-img"
                                    style="background-image: url({{ $item->image ? url(Storage::url($item->image)) : asset('techxen/assets/img/bg/hero6-bg1.png') }});">
                                </div>
                                <div class="tp-slider-shape-1 z-index-1">
                                    <img src="{{ asset('techxen') }}/assets/img/shapes/hero6-shape.png" alt="">
                                </div>
                                <div class="container _relative">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="tp-slider-content-wrap p-relative z-index-2">
                                                <div class="tp-slider-title-box p-relative">
                                                    <span class="span">Website Resmi {{ env('APP_NAME') }}</span>
                                                    <h1 class="tg-element-title">{{ $item->title }}</h1>
                                                    <div class="space16"></div>
                                                    <p>{{ $item->subtitle }}</p>
                                                </div>
                                                <div class="space30"></div>
                                                <div class="tp-slider-video-box d-flex align-items-center">
                                                    <div class="tp-slider-btn">
                                                        <a class="theme-btn1"
                                                            href="{{ $item->btn_link }}">{{ $item->btn_text }} <span
                                                                class="arrow1"><i
                                                                    class="fa-solid fa-arrow-right"></i></span><span
                                                                class="arrow2"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!--=====HERO AREA END=======-->

    <!--=====HERO AREA END=======-->

    <!--=====HERO BOTTOM AREA START=======-->

    <div class="mt-5">
        <div class="container">
            <div class="mt-1 row hero-bottom-area" style="z-index: 999999 !important;">
                <div class="col-lg-3">
                    <div class="single-box">
                        <div class="icon">
                            <img src="{{ asset('techxen') }}/assets/img/icons/hero-bottom-icon1.png" alt="">
                        </div>
                        <div class="headding">
                            <h5>74% Sudah Bekerja</h5>
                            <p>Sebelum 6 bulan lulus</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="single-box">
                        <div class="icon">
                            <img src="{{ asset('techxen') }}/assets/img/icons/hero-bottom-icon2.png" alt="">
                        </div>
                        <div class="headding">
                            <h5>26% Sudah Bekerja</h5>
                            <p>Setelah 6 bulan lulus</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="single-box">
                        <div class="icon">
                            <img src="{{ asset('techxen') }}/assets/img/icons/hero-bottom-icon3.png" alt="">
                        </div>
                        <div class="headding">
                            <h5>5000+ Mahasiswa</h5>
                            <p>Total Mahasiswa</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="single-box">
                        <div class="icon">
                            <img src="{{ asset('techxen') }}/assets/img/icons/hero-bottom-icon4.png" alt="">
                        </div>
                        <div class="headding">
                            <h5>4 Fakultas Unggulan</h5>
                            <p>Fakultas yang diminati</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--=====HERO BOTTOM AREA END=======-->

    <!--=====PROJECT AREA START=======-->

    <div class="project sp" style="background-color: transparent;">
        <div class="container">
            <div class="row">
                <div class="project-slider owl-carousel" data-aos="fade-up" data-aos-duration="800">
                    @foreach ($carousels as $item)
                        <div class="single-slider">
                            <div class="slider-img">
                                <img src="{{ $item->image ? url(Storage::url($item->image)) : asset('techxen/assets/img/bg/hero6-bg1.png') }}" alt="" style="height: 450px;object-fit: cover;width:100%;">
                            </div>
                            <div class="heading">
                                <h3><a href="{{ $item->btn_link }}">{{ $item->title }}</a></h3>
                                <a href="{{ $item->btn_link }}" class="learn">Selengkapnya <span><i
                                            class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!--=====PROJECT AREA END=======-->

    <!--=====ABOUT AREA START=======-->

    <div class="about1 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-image">
                        <div class="image1 reveal">
                            {{-- <img src="{{ asset('techxen') }}/assets/img/about/about1-img1.png" alt=""> --}}
                        </div>
                        <div class="image2 reveal image-anime">
                            @if ($hero_banner)
                                <img src="{{ url(Storage::url($hero_banner->image)) }}" alt="">
                            @else
                                <img src="{{ asset('techxen') }}/assets/img/about/thamrin-img.jpg" alt="">
                            @endif
                        </div>
                        <div class="icon-box">
                            <img src="{{ asset('img/fav.png') }}" alt="" style="width: 20px;">
                            <h4>Smart & Prudent</h4>
                            <p>{{ env('APP_NAME') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin-top: 100px;">
                    <div class="heading1">
                        @if ($hero_banner)
                            <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                    src="{{ asset('techxen') }}/assets/img/icons/span1.png"
                                    alt="">{{ $hero_banner->subtitle }}</span>
                            <h2 class="title tg-element-title">{{ $hero_banner->title }}</h2>
                            <div class="space16"></div>
                            <p data-aos="fade-left" data-aos-duration="800">{!! $hero_banner->desc !!}</p>
                        @else
                            <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                    src="{{ asset('techxen') }}/assets/img/icons/span1.png" alt="">Selamat Datang
                                di
                                Universitas MH Thamrin</span>
                            <h2 class="title tg-element-title">Masa Depan Dimulai di Sini!</h2>
                            <div class="space16"></div>
                            <p data-aos="fade-left" data-aos-duration="800">Universitas MH Thamrin hadir untuk mencetak
                                lulusan unggul yang siap bersaing di dunia kerja global. Dengan pengalaman lebih dari [X
                                tahun],
                                kami menawarkan program pendidikan berkualitas, kurikulum relevan dengan industri, dan
                                dukungan
                                pengembangan karier yang komprehensif.</p>
                        @endif

                        <ul class="list" data-aos="fade-left" data-aos-duration="1100">
                            <li><span><i class="fa-solid fa-check"></i></span> Program Sarjana dan Pascasarjana</li>
                            <li><span><i class="fa-solid fa-check"></i></span> Kurikulum berbasis kebutuhan industri </li>
                            <li><span><i class="fa-solid fa-check"></i></span> Kerja sama dengan perusahaan nasional dan
                                internasional.</li>
                        </ul>
                        <div class="space30"></div>
                        <div class="" data-aos="fade-left" data-aos-duration="900">
                            <a class="theme-btn1"
                                href="{{ $hero_banner != null ? $hero_banner->link : '#' }}">Pelajari Lebih Lanjut
                                <span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====ABOUT AREA END=======-->

    <!--=====CTA AREA START=======-->

    {{-- <div class="cta4">
        <a href="{{ $cta ? $cta->link : 'javascript:void(0)' }}" target="_blank">
            <div class="container">
                <img src="{{ $cta ? url(Storage::url($cta->image)) : asset('img/cta.jpg') }}" alt=""
                    style="width: 100%;">
            </div>
        </a>
    </div> --}}

    <div class="cta-carousel my-4">
        @if($ctas->count())
            <div id="ctaCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($ctas as $index => $cta)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <a href="{{ $cta->link ?? 'javascript:void(0)' }}" target="_blank">
                                <img src="{{ url(Storage::url($cta->image)) }}"
                                     class="d-block w-100"
                                     alt="CTA Image {{ $index + 1 }}"
                                     style="max-height: 500px; object-fit: cover;">
                            </a>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#ctaCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ctaCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @else
            <img src="{{ asset('img/cta.jpg') }}" class="d-block w-100" alt="Default CTA" />
        @endif
    </div>

    <!--=====CTA AREA END=======-->

    <!--=====BLOG AREA START=======-->

    <div class="blog sp">
        <div class="container">
            <div class="row">
                <div class="m-auto text-center col-lg-8">
                    <div class="heading1">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                src="{{ asset('img/fav.png') }}" alt="" style="width: 20px;"> Informasi &
                            Berita</span>
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
                                <img src="{{ $item->thumbnail ? url(Storage::url($item->thumbnail)) : asset('img/img-placeholder.webp') }}"
                                    alt="" style="width: 400px; height: 300px; object-fit: cover;">
                            </div>
                            <div class="heading">
                                <div class="tags">
                                    <a href="#"><img src="{{ asset('techxen') }}/assets/img/icons/blog-icon1.png"
                                            alt=""> {{ $item->user->name }}</a>
                                    <a href="#"><img src="{{ asset('techxen') }}/assets/img/icons/blog-icon2.png"
                                            alt="">
                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->format('d') }}
                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->format('M, Y') }}</span></a>
                                </div>
                                <h4><a
                                        href="{{ route('berita.detail', $item->slug) }}">{{ Str::limit($item->judul, 40) }}.</a>
                                </h4>
                                <a href="{{ route('berita.detail', $item->slug) }}" class="learn"> Selengkapnya <span><i
                                            class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!--=====BLOG AREA END=======-->

    <!--=====SERVICE AREA START=======-->

    <div class="service6 sp bg5" id="service">
        <div class="container">
            <div class="row">
                <div class="m-auto text-center col-lg-6">
                    <div class="heading1">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Layanan</span>
                        <h2 class="tg-element-title">Akses Layanan Digital <br><span>UMHT</span></h2>
                    </div>
                </div>
            </div>

            <div class="space30"></div>
            <div class="row">
                @foreach ($layanans as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-box" data-aos="fade-up" data-aos-duration="700">
                            <div class="">
                                <div class="icon">
                                    <img src="{{ $item->icon ? url(Storage::url($item->icon)) : asset('techxen/assets/img/icons/about-solution-iocn2.png') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="heading6">
                                <h4><a target="_blank" href="{{ $item->link }}">{{ $item->nama }}</a></h4>
                                <p>{{ $item->deskripsi }}</p>
                                <a target="_blank" href="{{ $item->link }}" class="learn">Akses <span><i
                                            class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--=====SERVICE AREA END=======-->

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctaCarousel = document.querySelector('#ctaCarousel');

                if (ctaCarousel) {
                    const carousel = new bootstrap.Carousel(ctaCarousel, {
                        interval: 5000, // 5 detik
                        ride: 'carousel',
                        pause: false // agar tetap jalan walau di-hover, bisa dihapus kalau tidak ingin
                    });
                }
            });
        </script>
    @endpush
@endsection
