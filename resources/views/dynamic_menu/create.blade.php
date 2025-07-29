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
                            <a href="{{ route('dashboard.dynamic_menu.index') }}" class="btn btn-warning"><i
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
                                <img src="{{ asset('img/menu cluster.webp') }}" alt="" style="width: 400px;">
                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.dynamic_menu.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-2">
                                        <label class="form-label">Nama Menu</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ old('nama') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Level Menu <span class="text-danger">*</span></label>
                                            <select name="level" id="level" class="form-control">
                                                <option value="1">Primary</option>
                                                <option value="2">Secondary</option>
                                                <option value="3">Tertiary</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 div_primary" style="display: none;">
                                        <div class="form-group">
                                            <label>Primary Menu <span class="text-danger">*</span></label>
                                            <select name="primary_menu_id" id="primary_menu_id" class="form-control">
                                                @foreach ($primary_menus as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 div_secondary" style="display: none;">
                                        <div class="form-group">
                                            <label>Secondary Menu <span class="text-danger">*</span></label>
                                            <select name="secondary_menu_id" id="secondary_menu_id" class="form-control">
                                                @foreach ($secondary_menus as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Isi Menu <span class="text-danger">*</span></label>
                                            <select name="tipe_menu" id="tipe_menu" class="form-control">
                                                <option value="link">Link</option>
                                                <option value="page">Halaman</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 div_link">
                                        <div class="form-group">
                                            <label>Link <span class="text-danger">*</span></label>
                                            <input type="text" name="link" class="form-control" value="{{ old('link') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 div_page" style="display: none">
                                        <div class="form-group">
                                            <label>Kaitkan Halaman <span class="text-danger">*</span></label>
                                            <select name="page_id" id="page_id" class="form-control">
                                                @foreach ($pages as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label>Background Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="hero_img">
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

@push('js')

@endpush
