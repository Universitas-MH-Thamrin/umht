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
              <a href="{{ route('dashboard.akreditasi.index') }}" class="btn btn-warning"><i
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
                  action="{{ isset($accreditation) ? route('dashboard.akreditasi.update', $accreditation->id) : route('dashboard.akreditasi.store') }}"
                  enctype="multipart/form-data">
                  @csrf
                  @if (isset($accreditation))
                    @method('PATCH')
                  @endif

                  <div class="mt-3 form-group col-md-6">
                    <label>Nama File</label>
                    <input type="text" class="form-control" name="name"
                      value="{{ old('name', $accreditation->name ?? '') }}" required>
                  </div>

                  <div class="mt-3 form-group col-md-6">
                    <label>Tanggal Berlaku</label>
                    <input type="date" class="form-control" name="expirated"
                      value="{{ old('expirated', $accreditation->expirated ?? '') }}" required>
                  </div>

                  <div class="mt-3 form-group col-md-4">
                    <label>Dokumen Akreditasi</label>
                    <input type="file" class="form-control" name="document">
                    @if (isset($accreditation) && $accreditation->document)
                      <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $accreditation->document) }}"
                          target="_blank">Lihat Dokumen</a></small>
                    @endif
                  </div>

                  <div class="mt-3 col-12">
                    <button class="btn btn-primary formSubmitter" type="submit">
                      {{ isset($accreditation) ? 'Update' : 'Simpan' }}
                    </button>
                  </div>
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
