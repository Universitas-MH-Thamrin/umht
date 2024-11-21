<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? env('APP_NAME') }}</title>

    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="{{ asset('img/fav.png') }}" type="image/x-icon">


    <meta property="og:title" content="{{ $title ?? env('APP_NAME') }}" />
    <meta property="og:description" content="Website Resmi {{ env('APP_NAME') }}" />
    <meta property="og:image" content="{{ asset('img/logo.png') }}" />

    <!--=====CSS=======-->
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/slick-slider.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/aos.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/mobile-menu.css">
    <link rel="stylesheet" href="{{ asset('techxen') }}/assets/css/main.css">

    @stack('css')


    <!--=====JQUERY=======-->
    <script src="{{ asset('techxen') }}/assets/js/jquery-3-7-1.min.js"></script>
</head>

<body class="body tg-heading-subheading animation-style3">


    <!--=====progress END=======-->

    <div class="paginacontainer">

        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

    </div>

    <!--=====progress END=======-->

    <!-- Preloader -->
    <section>
        <div id="preloader" style="display: none;">
            <div id="ctn-preloader" class="ctn-preloader ctn-preloader1">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        <span data-text-preloader="U" class="letters-loading">
                            U
                        </span>
                        <span data-text-preloader="M" class="letters-loading">
                            M
                        </span>
                        <span data-text-preloader="H" class="letters-loading">
                            H
                        </span>
                        <span data-text-preloader="T" class="letters-loading">
                            T
                        </span>
                    </div>
                </div>
                <div class="loader-section-left loader-section section-left"></div>
                <div class="loader-section-right loader-section section-right"></div>
            </div>
        </div>
    </section>


    <!--=====HEADER START=======-->

    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pera">
                        <p><img src="{{ asset('img/fav.png') }}" alt="" style="width: 20px;">
                            Website Resmi {{ env('APP_NAME') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="header-area header-area1 header-area-all d-none d-lg-block" id="header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-elements">
                            <div class="site-logo">
                                <a href="{{ route('front.index') }}">
                                    <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                                </a>
                            </div>


                            <div class="main-menu-ex main-menu-ex1">
                                <ul>

                                    <li class=""><a href="{{ route('front.index') }}">Home</a></li>

                                    @php
                                        $primary_menus = \App\Models\DynamicMenu::where('level', 1)
                                            ->orderBy('code')
                                            ->get();
                                    @endphp
                                    @foreach ($primary_menus as $pm)
                                        @php
                                            // cek jika ada secondary menu
                                            $secondary_menus = \App\Models\DynamicMenu::where(
                                                'code',
                                                'LIKE',
                                                $pm->code . '%',
                                            )
                                                ->where('level', 2)
                                                ->orderBy('code')
                                                ->get();

                                            // cek link atau submenu
                                            if ($secondary_menus->count() <= 0) {
                                                // cek tipe page atau link
                                                if ($pm->page_id == null) {
                                                    $pm_link = $pm->link;
                                                } else {
                                                    $pm_link = route('page.show', $pm->page->slug);
                                                }
                                            } else {
                                                $pm_link = 'javascript:void(0)';
                                            }
                                        @endphp
                                        <li class="dropdown-menu-parrent">
                                            <a href="{{ $pm_link }}">
                                                {{ $pm->nama }}
                                                @if ($secondary_menus->count() > 0)
                                                    <i class="fa-solid fa-angle-down"></i>
                                                @endif
                                            </a>
                                            @if ($secondary_menus->count() > 0)
                                                <ul>
                                                    @foreach ($secondary_menus as $sm)
                                                        @php
                                                            // cek tertiary menu
                                                            $tertiary_menus = \App\Models\DynamicMenu::where(
                                                                'code',
                                                                'LIKE',
                                                                $sm->code . '%',
                                                            )
                                                                ->where('level', 3)
                                                                ->orderBy('code')
                                                                ->get();

                                                            // cek link atau submenu
                                                            if ($tertiary_menus->count() <= 0) {
                                                                // cek tipe page atau link
                                                                if ($sm->page_id == null) {
                                                                    $sm_link = $sm->link;
                                                                } else {
                                                                    $sm_link = route('page.show', $sm->page->slug);
                                                                }
                                                            } else {
                                                                $sm_link = 'javascript:void(0)';
                                                            }
                                                        @endphp
                                                        <li>
                                                            <a href="{{ $sm_link }}">
                                                                {{ $sm->nama }}
                                                                @if ($tertiary_menus->count() > 0)
                                                                    <i class="fa-solid fa-angle-right"></i>
                                                                @endif
                                                            </a>
                                                            @if ($tertiary_menus->count() > 0)
                                                                <ul>
                                                                    @foreach ($tertiary_menus as $tm)
                                                                        @php
                                                                            // cek link atau submenu
                                                                            // cek tipe page atau link
                                                                            if ($tm->page_id == null) {
                                                                                $tm_link = $tm->link;
                                                                            } else {
                                                                                $tm_link = route(
                                                                                    'page.show',
                                                                                    $tm->page->slug,
                                                                                );
                                                                            }
                                                                        @endphp
                                                                        <li><a
                                                                                href="{{ $tm_link }}">{{ $tm->nama }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach

                                    {{-- <li class="dropdown-menu-parrent"><a href="#">Tentang <i
                                                class="fa-solid fa-angle-down"></i></a>
                                        <ul>
                                            <li><a href="javascript:void(0)">Selayang Pandang <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Visi, Misi, Tujuan</a></li>
                                                    <li><a href="#">Sambutan Rektor</a></li>
                                                    <li><a href="#">Penghargaan</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">Pimpinan <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Rektorat</a></li>
                                                    <li><a href="#">Dekanat</a></li>
                                                    <li><a href="#">Manajemen</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-menu-parrent"><a href="#">Akademik <i
                                                class="fa-solid fa-angle-down"></i></a>
                                        <ul>
                                            <li><a href="javascript:void(0)">Kesehatan <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Prodi Keperawatan</a></li>
                                                    <li><a href="#">Cek Lainnya</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">Manajemen <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Ekonomi</a></li>
                                                    <li><a href="#">Manajemen</a></li>
                                                    <li><a href="#">Cek Lainnya</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">Pendidikan <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Cek Lainnya</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Kalender Akademik</a></li>
                                            <li><a href="#">Kegiatan Akademik</a></li>
                                            <li><a href="#">Kehidupan Kampus</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown-menu-parrent"><a href="#">Penelitian <i
                                                class="fa-solid fa-angle-down"></i></a>
                                        <ul>
                                            <li><a href="javascript:void(0)">Penelitian Bidang Kesehatan <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Kesehatan A</a></li>
                                                    <li><a href="#">Kesehatan B</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">Penelitian Bidang Ekonomi <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Cek Lainnya</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-menu-parrent"><a href="#">Pengabdian <i
                                                class="fa-solid fa-angle-down"></i></a>
                                        <ul>
                                            <li><a href="javascript:void(0)">Pengabdian Bidang A <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Sub A</a></li>
                                                    <li><a href="#">Sub B</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">Pengabdian Bidang B <i
                                                        class="fa-solid fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Sub B</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-menu-parrent"><a href="#">Penerimaan <i
                                                class="fa-solid fa-angle-down"></i></a>
                                        <ul>
                                            <li><a href="javascript:void(0)">PMB Thamrin </a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>

                            <div class="header1-buttons">
                                <div class="contact-btn">
                                    <div class="icon">
                                        <img src="{{ asset('techxen') }}/assets/img/icons/header1-icon.png"
                                            alt="">
                                    </div>
                                    <div class="headding">
                                        <p>PMB 2024</p>
                                        <a href="https://pmb.radjakinstitute.id/">Daftar Sekarang!</a>
                                    </div>
                                </div>
                                <div class="button">
                                    <a class="theme-btn1" href="https://pmb.radjakinstitute.id/">PMB Thamrin <span><i
                                                class="fa-solid fa-arrow-right"></i></span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--=====HEADER END=======-->

    <!--=====Mobile header start=======-->
    <div class="mobile-header d-block d-lg-none ">
        <div class="container-fluid">
            <div class="col-12">
                <div class="mobile-header-elements">
                    <div class="mobile-logo">
                        <a href="javascript:void(0)"><img src="{{ asset('img/logo.png') }}" style="width: 200px;"
                                alt=""></a>
                    </div>
                    <div class="mobile-nav-icon">
                        <i class="fa-duotone fa-bars-staggered"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-sidebar d-block d-lg-none">
        <div class="logo-m">
            <a href="{{ route('front.index') }}"><img src="{{ asset('img/logo.png') }}"
                    style="width: 200px;background-color:white;padding:10px;border-radius:10px;" alt=""></a>
        </div>
        <div class="menu-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="mobile-nav">

            <ul>
                <li class="has-dropdown"><a href="#">Home </a>
                    <ul class="sub-menu">
                        <li class="has-dropdown has-dropdown1"><a href="#">Multipage</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('front.index') }}">Home 1</a></li>
                                <li><a href="javascript:void(0)">Home 2</a></li>
                                <li><a href="javascript:void(0)">Home 3</a></li>
                                <li><a href="javascript:void(0)">Home 4</a></li>
                                <li><a href="javascript:void(0)">Home 5</a></li>
                                <li><a href="javascript:void(0)">Home 6</a></li>
                                <li><a href="javascript:void(0)">Home 7</a></li>
                                <li><a href="javascript:void(0)">Home 8</a></li>
                                <li><a href="javascript:void(0)">Home 9</a></li>
                                <li><a href="javascript:void(0)">Home 10</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown has-dropdown1"><a href="#">Landing Page</a>
                            <ul class="sub-menu">
                                <li><a href="single-javascript:void(0)">Home 1</a></li>
                                <li><a href="single-javascript:void(0)">Home 2</a></li>
                                <li><a href="single-javascript:void(0)">Home 3</a></li>
                                <li><a href="single-javascript:void(0)">Home 4 </a></li>
                                <li><a href="single-javascript:void(0)">Home 5 </a></li>
                                <li><a href="single-javascript:void(0)">Home 6 </a></li>
                                <li><a href="single-javascript:void(0)">Home 7 </a></li>
                                <li><a href="single-javascript:void(0)">Home 8 </a></li>
                                <li><a href="single-javascript:void(0)">Home 9 </a></li>
                                <li><a href="single-javascript:void(0)">Home 10 </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Menu Mobile Belum wkwk</a></li>

            </ul>

            <div class="mobile-button">
                <a class="menu-btn2" href="javascript:void(0)">Akses PMB Online <span><i
                            class="fa-solid fa-arrow-right"></i></span></a>
            </div>

        </div>
    </div>

    <!--=====Mobile header end=======-->

    @yield('content')

    <!--=====CTA AREA START=======-->

    <div class="cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="heading1-w">
                        <h2 class="title tg-element-title">Siap Bergabung dengan Universitas MH. Thamrin?</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-right" data-aos-duration="700">Daftarkan dirimu sekarang dan mulailah
                            perjalanan akademik bersama Universitas MH Thamrin. Masa depan cemerlang ada di depan mata!
                        </p>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="buttons">
                        <a class="cta-btn1" href="https://pmb.radjakinstitute.id/">Mau Konsultasi Dulu <span><i
                                    class="fa-solid fa-arrow-right"></i></span></a>
                        <a class="cta-btn2" href="https://pmb.radjakinstitute.id/">Langsung Akses PMB<span><i
                                    class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====CTA AREA END=======-->

    <!--===== FOOTER AREA START =======-->

    <div class="footer1 _relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-footer-items footer-logo-area">
                        <div class="footer-logo">
                            <a href="#"><img src="{{ asset('img/logo.png') }}" alt=""
                                    style="width: 200px;"></a>
                        </div>
                        <div class="space20"></div>
                        <div class="heading1">
                            <p>Jl. H. Bokir Bin Dji'un (dh. Raya Pd. Gede) No.23-25, Dukuh, Kramat jati, Jakarta Timur,
                                13550 </p>
                        </div>
                        <ul class="social-icon">
                            <li><a href="https://www.linkedin.com/school/universitas-mh-thamrin/?originalSubdomain=id"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="https://www.youtube.com/c/UNIVERSITASMHTHAMRINCHANNEL/videos"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="https://www.instagram.com/universitasmhthamrin/"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Informasi</h3>

                        <ul class="menu-list">
                            <li><a href="{{ route('front.kontak') }}">Kontak</a></li>
                            <li><a href="{{ route('front.berita') }}">Berita</a></li>
                            <li><a href="{{ route('front.faq') }}">FAQs</a></li>
                            <li><a href="{{ route('front.foto') }}">Galeri Foto</a></li>
                            <li><a href="{{ route('front.video') }}">Galeri Video</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Link Terkait</h3>

                        <ul class="menu-list">
                            @php
                                $link_terkaits = \App\Models\LinkTerkait::where('visible', 1)->get();
                            @endphp
                            @foreach ($link_terkaits as $item)
                                <li><a href="{{ $item->link }}">{{ $item->nama }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="col-lg-2 col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Akreditasi</h3>
                        <img src="{{ asset('img/akreditasi.png') }}" alt="" style="width: 160px;">

                    </div>
                </div>

            </div>

            <div class="space40"></div>
        </div>

        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="coppyright">
                            <p>Copyright @ 2024 {{ env('APP_DESC') }}</p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="coppyright right-area">
                            <a href="{{ route('page.show', 'privacy-policy') }}">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--===== FOOTER AREA END =======-->


    <script src="{{ asset('techxen') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/aos.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/fontawesome.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/jquery.countup.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/mobile-menu.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/jquery.magnific-popup.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/slick-slider.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/gsap.min.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/ScrollTrigger.min.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/Splitetext.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/text-animation.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/SmoothScroll.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/jquery.lineProgressbar.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/ripple-btn.js"></script>
    <script src="{{ asset('techxen') }}/assets/js/main.js"></script>

    @stack('js')
</body>

</html>
