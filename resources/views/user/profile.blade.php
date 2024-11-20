@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="page-title">{{ $title }}</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('dashboard.user.profile_update', Auth::user()->id) }}" method="post"
                                    class="row myForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        @include('components.flash_messages')
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label">Nama</label>
                                        <span class="desc"></span>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $data->name }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label">Email</label>
                                        <span class="desc"></span>
                                        <div class="controls">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $data->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label">Password</label>
                                        <span class="desc"></span>
                                        <div class="controls">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>


                                    <div class="col-xs-12  padding-bottom-30">
                                        <div class="text-left">
                                            <button type="submit"
                                                class="btn btn-primary gradient-blue formSubmitter">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('components.footer')
    </div>
@endsection
