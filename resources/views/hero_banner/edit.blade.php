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
                                    <a href="{{ route('dashboard.hero_banner.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.hero_banner.update', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label">Link</label>
                                        <input type="text" class="form-control" name="link" value="{{ $data->link }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">SubTitle</label>
                                        <input type="text" class="form-control" name="subtitle" value="{{ $data->subtitle }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="desc" id="desc" class="form-control" cols="30" rows="4">{!! nl2br($data->desc) !!}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Poster / Gambar (Portrait 450px x 600px)</label>
                                            @if ($data->image)
                                                <br>
                                                <img src="{{ MyHelper::get_avatar($data->image) }}" alt="" style="width: 300px;">
                                                <br><br>
                                            @endif
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <img src="{{ asset('img/hero-banner.png') }}" alt="" style="width: 100%;border: 2px solid black;">
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
