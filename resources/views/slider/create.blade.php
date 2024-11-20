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
                            <a href="{{ route('dashboard.slider.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                                    action="{{ route('dashboard.slider.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">SubTitle</label>
                                        <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Teks Tombol</label>
                                        <input type="text" class="form-control" name="btn_text" value="{{ old('btn_text') }}">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Link Tombol</label>
                                        <input type="text" class="form-control" name="btn_link" value="{{ old('btn_link') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Visible</label>
                                        <select name="visible" id="visible" class="form-control" required>
                                            <option value="">-- Pilih Visibilitas --</option>
                                            <option value="1" selected>Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Foto</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
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
