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
                                    <a href="{{ route('dashboard.video.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.video.update', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-9">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>Folder</label>
                                            <select name="folder_id" id="folder_id" class="form-control">
                                                <option value="">Pilih</option>
                                                @foreach ($folders as $item)
                                                    <option value="{{ $item->id }}" {{ $data->folder_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Video (mp4,avi,mov)</label>
                                            <input type="file" class="form-control" name="file">
                                            @if ($data->file)
                                                <br>
                                                <a href="{{ url(Storage::url($data->file)) }}">Lihat Video Saat ini</a>
                                                <br><br>
                                            @endif
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
