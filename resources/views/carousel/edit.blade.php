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
                                    <a href="{{ route('dashboard.slider.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.slider.update', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">SubTitle</label>
                                        <input type="text" class="form-control" name="subtitle" value="{{ $data->subtitle }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Teks Tombol</label>
                                        <input type="text" class="form-control" name="btn_text" value="{{ $data->btn_text }}">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Link Tombol</label>
                                        <input type="text" class="form-control" name="btn_link" value="{{ $data->btn_link }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Visible</label>
                                        <select name="visible" id="visible" class="form-control" required>
                                            <option value="">-- Pilih Visibilitas --</option>
                                            <option value="1" {{ $data->visible == 1 ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ $data->visible == 0 ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Foto</label>
                                            @if ($data->image)
                                                <br>
                                                <img src="{{ MyHelper::get_avatar($data->image) }}" alt="" style="width: 100px;">
                                                <br><br>
                                            @endif
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
