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
                            <a href="{{ route('dashboard.link_terkait.index') }}" class="btn btn-warning"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
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
                                    action="{{ route('dashboard.link_terkait.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ old('nama') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Link</label>
                                        <input type="text" class="form-control" name="link"
                                            value="{{ old('link') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Visible</label>
                                        <select name="visible" id="visible" class="form-control" required>
                                            <option value="">-- Pilih Visibilitas --</option>
                                            <option value="1" selected>Ya</option>
                                            <option value="0">Tidak</option>
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