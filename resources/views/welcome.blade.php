@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    <div class="hero1"
        style="background-image: url(assets/img/bg/hero1-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
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
                    <div class="hero1-all-images">
                        <div class="image1 ">
                            {{-- <img src="{{ asset('techxen') }}/assets/img/hero/hero1-image1.png" alt=""> --}}
                            <img src="{{ asset('img/thamrin.png') }}" alt="">
                        </div>
                        <div class="image2 reveal">
                            <img src="{{ asset('techxen') }}/assets/img/hero/hero1-image2.png" alt="">
                        </div>
                        <div class="image3 shape-animaiton3">
                            {{-- <img src="{{ asset('techxen') }}/assets/img/hero/hero1-image3.png" alt=""> --}}
                        </div>
                        <div class="image4 shape-animaiton3">
                            {{-- <img src="{{ asset('techxen') }}/assets/img/hero/hero1-image4.png" alt=""> --}}
                        </div>
                        <div class="shape1">
                            <img src="{{ asset('techxen') }}/assets/img/shapes/header1-shape1.png" alt="">
                        </div>
                        <div class="shape2">
                            <img src="{{ asset('techxen') }}/assets/img/shapes/header1-shape2.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--=====HERO AREA END=======-->

    <!--=====HERO BOTTOM AREA START=======-->

    <div class="">
        <div class="container">
            <div class="row hero-bottom-area">
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
                    <div class="single-slider">
                        <div class="slider-img">
                            <img src="{{ asset('techxen') }}/assets/img/work/project-img1.png" alt="">
                        </div>
                        <div class="heading">
                            <h3><a href="javascript:void(0)">Fasilitas</a></h3>
                            <a href="javascript:void(0)" class="learn">Selengkapnya <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>

                    <div class="single-slider">
                        <div class="slider-img">
                            <img src="{{ asset('techxen') }}/assets/img/work/project-img2.png" alt="">
                        </div>
                        <div class="heading">
                            <h3><a href="javascript:void(0)">Kehidupan Kampus</a></h3>
                            <a href="javascript:void(0)" class="learn">Selengkapnya <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>

                    <div class="single-slider">
                        <div class="slider-img">
                            <img src="{{ asset('techxen') }}/assets/img/work/project-img3.png" alt="">
                        </div>
                        <div class="heading">
                            <h3><a href="javascript:void(0)">Kualitas Lulusan</a></h3>
                            <a href="javascript:void(0)" class="learn">Selengkapnya <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
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
                            <img src="{{ asset('techxen') }}/assets/img/about/about1-img1.png" alt="">
                        </div>
                        <div class="image2 reveal image-anime">
                            <img src="{{ asset('techxen') }}/assets/img/about/about1-img2.png" alt="">
                        </div>
                        <div class="icon-box">
                            <img src="{{ asset('img/fav.png') }}" alt="" style="width: 20px;">
                            <h4>Smart & Prudent</h4>
                            <p>{{ env('APP_NAME') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="heading1">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                src="{{ asset('techxen') }}/assets/img/icons/span1.png" alt="">Selamat Datang di
                            Universitas MH Thamrin</span>
                        <h2 class="title tg-element-title">Masa Depan Dimulai di Sini!</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-left" data-aos-duration="800">Universitas MH Thamrin hadir untuk mencetak
                            lulusan unggul yang siap bersaing di dunia kerja global. Dengan pengalaman lebih dari [X tahun],
                            kami menawarkan program pendidikan berkualitas, kurikulum relevan dengan industri, dan dukungan
                            pengembangan karier yang komprehensif.</p>

                        <ul class="list" data-aos="fade-left" data-aos-duration="1100">
                            <li><span><i class="fa-solid fa-check"></i></span> Program Sarjana dan Pascasarjana</li>
                            <li><span><i class="fa-solid fa-check"></i></span> Kurikulum berbasis kebutuhan industri </li>
                            <li><span><i class="fa-solid fa-check"></i></span> Kerja sama dengan perusahaan nasional dan
                                internasional.</li>
                        </ul>
                        <div class="space30"></div>
                        <div class="" data-aos="fade-left" data-aos-duration="900">
                            <a class="theme-btn1" href="#">Pelajari Lebih Lanjut <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====ABOUT AREA END=======-->

    <!--=====CTA AREA START=======-->

    <div class="cta4">
        <a href="">
            <div class="container">
                <img src="{{ asset('img/cta.jpg') }}" alt="" style="width: 100%;">
            </div>
        </a>
    </div>

    <!--=====CTA AREA END=======-->

    <!--=====BLOG AREA START=======-->

    <div class="blog sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
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
                                    alt="" style="height: 300px;object-fit: cover;">
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
                <div class="col-lg-6 m-auto text-center">
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
                                    <img src="{{ $item->icon ? url(Storage::url($item->icon)) : asset('techxen/assets/img/icons/about-solution-iocn2.png') }}" alt="">
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
@endsection
