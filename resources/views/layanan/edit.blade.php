@extends('layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">{{ $title }}</h4>
                                    <a href="{{ route('dashboard.layanan.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.layanan.update', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-1">
                                        <label class="form-label">Urutan</label>
                                        <input type="number" class="form-control" name="urutan" value="{{ $data->urutan }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" name="deskripsi" value="{{ $data->deskripsi }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Link</label>
                                        <input type="text" class="form-control" name="link" value="{{ $data->link }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Visible</label>
                                        <select name="visible" id="visible" class="form-control" required>
                                            <option value="">-- Pilih Visibilitas --</option>
                                            <option value="1" {{ $data->visible == 1 ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ $data->visible == 0 ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Icon Layanan Digital</label>
                                            @if ($data->icon)
                                                <br>
                                                <img src="{{ MyHelper::get_avatar($data->icon) }}" alt="" style="width: 100px;">
                                                <br><br>
                                            @endif
                                            <input type="file" class="form-control" name="icon">
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
