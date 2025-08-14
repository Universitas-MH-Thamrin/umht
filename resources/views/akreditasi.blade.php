@extends('layouts.front')

@section('content')
  <!--=====HERO AREA START=======-->
  {{-- <div class="common-hero">
    <div class="container">
      <div class="text-center row align-items-center">
        <div class="m-auto col-lg-8">
          <div class="main-heading">
            <h1>{{ $title }}</h1>
            <div class="space16"></div>
            <span class="span">
              <img src="assets/img/icons/span1.png" alt="">
              <a href="{{ route('front.index') }}">Home</a>
              <i class="fa-regular fa-angle-right"></i> Halaman
              <i class="fa-regular fa-angle-right"></i> {{ $title }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

    @php
      $heroImageUrl = $hero_img ? asset(\Illuminate\Support\Facades\Storage::url($hero_img)) : asset(\Illuminate\Support\Facades\Storage::url('public/img/img-1920x640.png'));
    @endphp
    <div class="common-hero position-relative text-white text-center">

      {{-- Versi Desktop (img) --}}
      <img src="{{ $heroImageUrl }}"
           alt="Akreditasi"
           class="w-100 h-auto d-none d-md-block">

      {{-- Versi Mobile (background) --}}
      <div class="d-block d-md-none position-absolute top-0 start-0 w-100 h-100"
          style="background: url('{{ $heroImageUrl }}') center center / cover no-repeat;">
      </div>

      {{-- Overlay Gradient --}}
      <div class="position-absolute top-0 start-0 w-100 h-100"
           style="background: linear-gradient(to top, rgb(37, 100, 235), transparent, transparent);"></div>

      {{-- Text Content --}}
      <div class="position-absolute w-100 h-100 text-center px-4 d-flex flex-column justify-content-center align-items-center"
           style="padding-top: 150px;">
          <h1 class="fw-bold mb-3 fs-1 md:fs-2">Akreditasi</h1>
          <div class="d-flex justify-content-center align-items-center gap-2 small fs-5 md:fs-4"
               style="color: rgba(255,255,255,0.85);">
              <a href="{{ route('front.index') }}" class="text-white text-decoration-underline">Home</a>
              <span>&gt; Halaman &gt;</span>
              <span>Akreditasi</span>
          </div>
      </div>
  </div>

  <!--=====SERVICE DETAILS AREA START=======-->
  <div class="service-details-area-all sp">
    <div class="container">
      <div class="row">
        <div class="m-auto col-lg-8">
          <div class="service-details-post">
            <article>
              <div class="details-post-area">
                <div class="heading1">
                  <h2>{{ $title }}</h2>
                  <div class="space16"></div>
                  <!-- Form Search -->
                  <form method="GET" action="{{ route('akreditasi.getAll') }}" class="mb-4">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama file"
                        value="{{ request('search') }}">
                      <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                  </form>
                  <div class="table-responsive">
                    <table class="table text-center table-bordered table-striped table-hover w-100">
                      <thead class="table">
                        <tr>
                          <th>NO</th>
                          <th>Nama File</th>
                          <th>Tanggal Berlaku</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($accreditations as $accreditation)
                          <tr>
                            <td>{{ $loop->iteration + $accreditations->firstItem() - 1 }}</td>
                            <td>{{ $accreditation->name }}</td>
                            <td>{{ $accreditation->formatted_date }}</td>
                            <td>
                              <a href="{{ asset('storage/' . $accreditation->document) }}" class="btn cta-btn2"
                                target="_blank">
                                Detail
                              </a>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- Pagination -->
                  {{ $accreditations->withQueryString()->links() }}
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--=====SERVICE DETAILS AREA END=======-->
@endsection
