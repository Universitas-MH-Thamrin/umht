@extends('layouts.front')

@section('content')
    <!--=====HERO AREA START=======-->

    <div class="common-hero">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-8 m-auto">
                    <div class="main-heading">
                        <h1>Kontak</h1>
                        <div class="space16"></div>
                        <span class="span"><img src="{{ asset('techxen') }}/assets/img/icons/span1.png" alt=""> <a
                                href="{{ route('front.index') }}">Home</a>
                            <i class="fa-regular fa-angle-right"></i></span> Kontak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====CONTACT AREA START=======-->

    <div class="contact-page mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-boxs">
                        <div class="heading1">
                            <h2>Kontak Kami</h2>
                            <div class="space16"></div>
                            <p>Hubungi Kami melalui informasi kontak dibawah ini</p>
                        </div>
                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{ asset('techxen') }}/assets/img/icons/contact-page-icon1.png" alt="">
                            </div>
                            <div class="heading">
                                <h5>Contact Us</h5>
                                <a href="wa.me/6281110105708" class="text">6281110105708</a>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{ asset('techxen') }}/assets/img/icons/contact-page-icon2.png" alt="">
                            </div>
                            <div class="heading">
                                <h5>Email</h5>
                                <a href="mailto:info@thamrin.ac.id" class="text">info@thamrin.ac.id</a>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{ asset('techxen') }}/assets/img/icons/contact-page-icon3.png" alt="">
                            </div>
                            <div class="heading">
                                <h5>Alamat</h5>
                                <a href="#" class="text">
                                    Jl. H. Bokir Bin Dji'un (dh. Raya Pd. Gede) No.23-25, Dukuh, Kramat jati, Jakarta Timur, 13550</a>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-6">
                    @include('components.flash_messages')
                    <div class="contact-form-details">
                        <form method="post" action="{{ route('front.kontak.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single-input">
                                        <input type="text" placeholder="Nama" name="name">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single-input">
                                        <input type="email" placeholder="Email" name="email">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single-input">
                                        <input type="phone" placeholder="Phone" name="phone">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single-input">
                                        <input type="text" placeholder="Subject" name="subject">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single-input">
                                        <textarea cols="30" rows="5" placeholder="Message" name="message"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button class="theme-btn1" type="submit">Submit <span><i
                                                class="fa-solid fa-arrow-right"></i></span></button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====CONACT AREA END=======-->
    <div class="space100"></div>

    <div class="contact-map-page">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15863.267245921046!2d106.8745879!3d-6.2877939!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2856f9495b7%3A0x97d08a373ba6b2ef!2sMH.Thamrin%20Pondok%20Gede!5e0!3m2!1sen!2sid!4v1732160019180!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
