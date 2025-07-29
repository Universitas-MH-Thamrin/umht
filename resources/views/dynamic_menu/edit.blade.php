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
                                    <a href="{{ route('dashboard.dynamic_menu.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.dynamic_menu.update', $data->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-2">
                                        <label class="form-label">Code</label>
                                        <input type="text" class="form-control" name="code"
                                            value="{{ $data->code }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Nama Menu</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $data->nama }}">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Level Menu <span class="text-danger">*</span></label>
                                            <select name="level" id="level" class="form-control">
                                                <option value="1" {{ $data->level == 1 ? 'selected' : '' }}>Primary</option>
                                                <option value="2" {{ $data->level == 2 ? 'selected' : '' }}>Secondary</option>
                                                <option value="3" {{ $data->level == 3 ? 'selected' : '' }}>Tertiary</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 div_primary" style="display: {{ $data->level >= 2 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <label>Primary Menu <span class="text-danger">*</span></label>
                                            <select name="primary_menu_id" id="primary_menu_id" class="form-control">
                                                @foreach ($primary_menus as $item)
                                                    <option value="{{ $item->id }}" {{ $item->code == substr($data->code, 0, 1) ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 div_secondary" style="display: {{ $data->level >= 2 ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <label>Secondary Menu <span class="text-danger">*</span></label>
                                            <select name="secondary_menu_id" id="secondary_menu_id" class="form-control">
                                                @foreach ($secondary_menus as $item)
                                                    <option value="{{ $item->id }}" {{ $item->code == substr($data->code, 0, 3) ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Isi Menu <span class="text-danger">*</span></label>
                                            <select name="tipe_menu" id="tipe_menu" class="form-control">
                                                <option value="link" {{ $data->page_id == NULL ? 'selected' : '' }}>Link</option>
                                                <option value="page" {{ $data->page_id != NULL ? 'selected' : '' }}>Halaman</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 div_link" style="display: {{ $data->page_id == NULL ? 'block' : 'none' }}">
                                        <div class="form-group">
                                            <label>Link <span class="text-danger">*</span></label>
                                            <input type="text" name="link" class="form-control" value="{{ $data->link }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 div_page" style="display: {{ $data->page_id == NULL ? 'none' : 'block' }}">
                                        <div class="form-group">
                                            <label>Kaitkan Halaman <span class="text-danger">*</span></label>
                                            <select name="page_id" id="page_id" class="form-control">
                                                @foreach ($pages as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $data->page_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label>Background Image</label>
                                        @if ($data->hero_img)
                                            <br>
                                            <img src="{{ MyHelper::get_avatar($data->hero_img) }}" alt="" style="width: 100px;">
                                            <br><br>
                                        @endif
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
