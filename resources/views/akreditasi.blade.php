@extends('layouts.front')

@section('content')
  <!--=====HERO AREA START=======-->
  <div class="common-hero">
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
