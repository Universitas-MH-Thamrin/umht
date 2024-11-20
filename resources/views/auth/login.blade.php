@extends('layouts.front')

@section('content')
    <main class="main">

        <div class="site-breadcrumb" style="background: url({{ asset('taxrio') }}/assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Login</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>


        <div class="login-area py-120" style="padding: 100px 0px 50px 0px;">
            <div class="container">
                <div class="col-md-5 mx-auto border p-5">
                    <div class="login-form">
                        <div class="login-header text-center">
                            <img src="{{ asset('img/logo.png') }}" style="width: 200px;">
                            <p style="margin-top: 10px;margin-bottom:20px;">Login ke dalam sistem</p>
                        </div>

                        @include('components.flash_messages')
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="far fa-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value id="remember">
                                    <label class="form-check-label" for="remember">
                                        Ingat saya
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn btn btn-primary"><span class="far fa-sign-in"></span>
                                    Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
