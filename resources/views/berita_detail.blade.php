@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    <div class="common-hero">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-8 m-auto">
                    <div class="main-heading">
                        <h2>{{ $data->judul }}</h2>
                        <div class="space16"></div>
                        <span class="span"><img src="assets/img/icons/span1.png" alt=""> <a
                                href="{{ route('front.index') }}">Home</a>
                            <i class="fa-regular fa-angle-right"></i></span>
                        <a href="{{ route('front.berita') }}">
                            Berita
                        </a>
                        </span>
                        <i class="fa-regular fa-angle-right"></i></span> {{ $data->judul }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====SERVICE DETAILS AREA START=======-->

    <div class="service-details-area-all sp">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 details-right-space">
                    <div class="service-details-post">
                        <article>
                            <div class="details-post-area">
                                <div class="image">
                                    <img src="{{ $data->thumbnail ? url(Storage::url($data->thumbnail)) : asset('img/img-placeholder.webp') }}" alt="">
                                </div>
                                <div class="social-users">
                                    <ul>
                                        <li><a href="#"><img src="{{ asset('techxen') }}/assets/img/icons/user-icon1.png" alt=""> {{ $data->user->name }}</a></li>
                                    <li><a href="#"><img src="{{ asset('techxen') }}/assets/img/icons/user-icon2.png" alt=""> {{ \Carbon\Carbon::parse($data->created_at)->locale('id_ID')->format('d') }} {{ \Carbon\Carbon::parse($data->created_at)->locale('id_ID')->format('M, Y') }}</a></li>
                                    <li><a href="#"><img src="{{ asset('techxen') }}/assets/img/icons/user-icon3.png" alt=""> {{ $data->kategori->nama }}</a></li>
                                    </ul>
                                </div>
                                <div class="space30"></div>
                                <h2>{{ $data->judul }}</h2>
                                <div class="space16"></div>
                                {!! $data->deskripsi !!}
                            </div>
                        </article>
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="sidebar-box-area sidebar-bg mb-40">
                        <h3>Berita Terbaru</h3>
                        <div class="sidebar-blog-boxs">
                            @foreach ($beritas as $item)
                                <div class="sidebar-blogs">
                                    <div class="">
                                        <div class="image">
                                            <img src="{{ $item->thumbnail ? url(Storage::url($item->thumbnail)) : asset('img/img-placeholder.webp') }}" alt="" style="width: 400px; height: 300px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="heading">
                                        <a href="#" class="date"><img src="{{ asset('techxen') }}/assets/img/icons/date.png"
                                                alt=""> {{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->format('d') }}
                                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->format('M, Y') }}</a>
                                        <h5><a href="{{ route('berita.detail', $item->slug) }}">{{ Str::limit($item->judul, 40) }}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====SERVICE DETAILS AREA END=======-->
@endsection
