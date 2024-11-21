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
                        <span class="span"><img src="{{ asset('techxen') }}/assets/img/icons/span1.png" alt=""> <a
                                href="{{ route('front.index') }}">Home</a>
                            <i class="fa-regular fa-angle-right"></i></span> {{ $title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====FAQ AREA END=======-->

    <div class="faq3 sp" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-4 popup-gallery">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('front.video') }}" class="btn btn-info text-white">All</a>
                            @foreach ($folders as $folder)
                                <a href="{{ route('front.video_folder', $folder->id) }}"
                                    class="btn btn-info text-white">{{ $folder->nama }}</a>
                            @endforeach
                        </div>
                        @foreach ($videos as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="project-page-box">
                                    <div class="image border">
                                        <img src="{{ asset('img/video-placeholder.jpg') }}" alt=""
                                            style="height: 250px;object-fit: cover;">
                                    </div>
                                    <div class="heading2">
                                        <h4><a href="{{ url(Storage::url($item->file)) }}">{{ $item->nama }}</a></h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-area">
                        {{ $videos->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====FAQ AREA END=======-->
@endsection
