@extends('layouts.front')

@section('content')
  <!--=====HERO AREA START=======-->
  {{-- <div class="common-hero">
    <div class="container">
      <div class="text-center row align-items-center">
        <div class="m-auto col-lg-8">
          <div class="main-heading">
            <h1>{{ $title }}</h1>
            <div class="space16"></div>
            <span class="span">
              <img src="assets/img/icons/span1.png" alt="">
              <a href="{{ route('front.index') }}">Home</a>
              <i class="fa-regular fa-angle-right"></i> Halaman
              <i class="fa-regular fa-angle-right"></i> {{ $title }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  @php
    $heroImageUrl = $hero_img ? asset(\Illuminate\Support\Facades\Storage::url($hero_img)) : asset(\Illuminate\Support\Facades\Storage::url('public/img/img-1920x640.png'));
  @endphp
  <div class="common-hero position-relative text-white text-center">

    {{-- Versi Desktop (img) --}}
    <img src="{{ $heroImageUrl }}"
         alt="{{ $title }}"
         class="w-100 h-auto d-none d-md-block">

    {{-- Versi Mobile (background) --}}
    <div class="d-block d-md-none position-absolute top-0 start-0 w-100 h-100"
        style="background: url('{{ $heroImageUrl }}') center center / cover no-repeat;">
    </div>

    {{-- Overlay Gradient --}}
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: linear-gradient(to top, rgb(37, 100, 235), transparent, transparent);"></div>

    {{-- Text Content --}}
    <div class="position-absolute w-100 h-100 text-center px-4 d-flex flex-column justify-content-center align-items-center"
         style="padding-top: 150px;">
        <h1 class="fw-bold mb-3 fs-1 md:fs-2">{{ $title }}</h1>
        <div class="d-flex justify-content-center align-items-center gap-2 small fs-5 md:fs-4"
             style="color: rgba(255,255,255,0.85);">
            <a href="{{ route('front.index') }}" class="text-white text-decoration-underline">Home</a>
            <span>&gt; Halaman &gt;</span>
            <span>{{ $title }}</span>
        </div>
    </div>
</div>

  <!--=====SERVICE DETAILS AREA START=======-->
  <div class="service-details-area-all sp">
    <div class="container">
        <div class="row">
            <div class="m-auto col-lg-8">
                <div class="service-details-post">
                    <article>
                        @if($testimonials->count())
                            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($testimonials as $index => $testimonial)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-3 gap-md-4 text-center text-md-start">

                                                {{-- Foto --}}
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                         alt="{{ $testimonial->name }}"
                                                         class="rounded-circle"
                                                         style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>

                                                {{-- Teks --}}
                                                <div class="flex-grow-1">
                                                    <div class="mb-2">
                                                        <h5 class="mb-1">{{ $testimonial->name }}</h5>
                                                        <p class="text-muted mb-0">{{ $testimonial->profession }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="fst-italic">"{{ $testimonial->description }}"</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Navigasi Carousel --}}
                                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" style="background-color: black;"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" style="background-color: black;"></span>
                                </button>
                            </div>
                        @else
                            <p class="text-center">Belum ada testimonial alumni.</p>
                        @endif
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
  <!--=====SERVICE DETAILS AREA END=======-->

  @push('js')
    <script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
            items: 1
            },
            768: {
            items: 1
            },
            992: {
            items: 2
            }
        }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('#testimonialCarousel .carousel-item');
        let maxHeight = 0;

        items.forEach(item => {
            item.style.height = 'auto'; // reset dulu
            const height = item.offsetHeight;
            if (height > maxHeight) maxHeight = height;
        });

        items.forEach(item => {
            item.style.height = maxHeight + 'px';
        });
    });
    </script>
    @endpush

@endsection
