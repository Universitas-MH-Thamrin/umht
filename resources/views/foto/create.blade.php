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
                            <a href="{{ route('dashboard.foto.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                                    action="{{ route('dashboard.foto.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-9">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>Folder</label>
                                            <select name="folder_id" id="folder_id" class="form-control">
                                                <option value="">Pilih</option>
                                                @foreach ($folders as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Foto</label>
                                            <input type="file" class="form-control" name="file">
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
