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
              <a href="{{ route('dashboard.testimonial.index') }}" class="btn btn-warning"><i
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
                  action="{{ isset($testimonial) ? route('dashboard.testimonial.update', $testimonial->id) : route('dashboard.testimonial.store') }}"
                  enctype="multipart/form-data">
                  @csrf
                  @if (isset($testimonial))
                    @method('PATCH')
                  @endif

                  <div class="mt-3 form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name"
                      value="{{ old('name', $testimonial->name ?? '') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                  </div>

                  <div class="mt-3 form-group col-md-6">
                    <label>Profesi</label>
                    <input type="text" class="form-control" name="profession"
                      value="{{ old('profession', $testimonial->profession ?? '') }}" required>
                        @error('profession')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                  </div>

                  <div class="mt-3 form-group col-md-12">
                    <label for="description">Keterangan</label>
                    <textarea
                      class="form-control @error('description') is-invalid @enderror"
                      name="description"
                      id="description"
                      required>{{ old('description', $testimonial->description ?? '') }}</textarea>

                    @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="mt-3 form-group col-md-4">
                    <label>Foto</label>
                    <input type="file" class="form-control" name="image" accept="image/*">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                  </div>

                  <div class="mt-3 form-group col-md-4">
                    @if (isset($testimonial) && $testimonial->image)
                        <small class="text-muted">
                            Gambar saat ini:
                            <br>
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Gambar Akreditasi" class="img-fluid mt-2" style="max-height: 200px;">
                        </small>
                    @endif
                  </div>

                  <div class="mt-3 col-12">
                    <button class="btn btn-primary formSubmitter" type="submit">
                      {{ isset($testimonial) ? 'Update' : 'Simpan' }}
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
