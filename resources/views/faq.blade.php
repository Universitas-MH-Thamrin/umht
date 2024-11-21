@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    <div class="common-hero">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-8 m-auto">
                    <div class="main-heading">
                        <h1>FAQ</h1>
                        <div class="space16"></div>
                        <span class="span"><img src="{{ asset('techxen') }}/assets/img/icons/span1.png" alt=""> <a
                                href="{{ route('front.index') }}">Home</a>
                            <i class="fa-regular fa-angle-right"></i></span> FAQ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====FAQ AREA END=======-->

    <div class="faq3 sp" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="heading3">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"> FAQ’S</span>
                        <h2 class="title tg-element-title">Pertanyaan yang sering diajukan</h2>
                    </div>
                </div>
            </div>

            <div class="space40"></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($faqs as $item)
                            <div class="accordion-item" data-aos="fade-up" data-aos-duration="700">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $item->id }}" aria-expanded="false"
                                        aria-controls="flush-collapse{{ $item->id }}">
                                        {{ $item->pertanyaan }}
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $item->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">{!! $item->jawaban !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====FAQ AREA END=======-->
@endsection
