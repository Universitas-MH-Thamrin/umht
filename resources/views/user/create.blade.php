@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="page-title">{{ $title }}</h6>
                        </div>
                        <div class="">
                            <a href="{{ route('dashboard.user.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.user.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label">Nama</label>
                                        <span class="desc"></span>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label">Email</label>
                                        <span class="desc"></span>
                                        <div class="controls">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label class="form-label">Password</label>
                                        <span class="desc"></span>
                                        <div class="controls">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 col-md-3 div_bidang">
                                        <label class="form-label">Role</label>
                                        <span class="desc"></span>
                                        <select name="role" id="role" class="form-control">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>

                                    <!-- end col -->
                                    <div class="col-12">
                                        <button class="btn btn-primary formSubmitter" type="submit">Simpan</button>
                                    </div>
                                    <!-- end col -->
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
