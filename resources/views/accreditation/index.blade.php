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
              <a href="{{ route('dashboard.akreditasi.create') }}" class="btn btn-primary">Tambah</a>
            </div>
          </div>
        </div>
        <!-- end page title -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                @include('components.flash_messages')

                <!-- Search Form -->
                <form action="{{ route('dashboard.akreditasi.index') }}" method="GET" class="mb-3">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama dokumen"
                      value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                  </div>
                </form>

                <!-- Table Akreditasi -->
                <div class="table-responsive">
                  <table class="table table-bordered nowrap w-100">
                    <thead>
                      <tr>
                        <th>#</th>
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
                            <a href="{{ asset('storage/' . $accreditation->document) }}"
                              class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('dashboard.akreditasi.edit', $accreditation->id) }}"
                              class="btn btn-sm btn-warning">Edit</a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                              onclick="confirmDelete('{{ route('dashboard.akreditasi.destroy', $accreditation->id) }}')">
                              Hapus
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
                  <!-- Modal Konfirmasi Hapus -->
                  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Apakah Anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                          <form id="deleteForm" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Pagination -->
                <div class="mt-3">
                  {{ $accreditations->appends(request()->query())->links() }}
                </div>
              </div>
            </div>
          </div> <!-- end col -->
        </div> <!-- end row -->
      </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('components.footer')
  </div>
  <script>
    function confirmDelete(action) {
      const deleteForm = document.getElementById('deleteForm');
      deleteForm.action = action; // Set action pada form delete
      const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
      deleteModal.show(); // Tampilkan modal
    }
  </script>
@endsection