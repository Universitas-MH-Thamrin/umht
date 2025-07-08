@extends('layouts.front')

@section('content')
  <!--=====HERO AREA START=======-->
  <div class="common-hero">
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
                                    <div class="d-flex flex-row align-items-start gap-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                alt="{{ $testimonial->name }}"
                                                class="rounded-circle"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>
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
