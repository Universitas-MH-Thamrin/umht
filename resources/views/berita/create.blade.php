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
                            <a href="{{ route('dashboard.berita.index') }}" class="btn btn-warning"><i
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
                                    action="{{ route('dashboard.berita.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-md-12 mt-3">
                                        <label>Judul Berita</label>
                                        <input type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <label>Deskripsi</label>
                                        <textarea class="ckeditor-classic" name="deskripsi" id="deskripsi" cols="30" rows="4">{!! old('deskripsi') !!}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategoris as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Publish ?</label>
                                        <select name="visible" id="visible" class="form-control" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="1" selected>Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                        <label>Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail">
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
    <script src="{{ asset('skote') }}/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <script>
        var ckClassicEditor = document.querySelectorAll(".ckeditor-classic"),
            snowEditor = (ckClassicEditor && Array.from(ckClassicEditor).forEach(function() {
                ClassicEditor.create(document.querySelector(".ckeditor-classic"), {
                    ckfinder: {
                        uploadUrl: '{{ route("dashboard.helper.ckeditor_upload") }}?_token=' + document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    }
                }).then(function(e) {
                    e.ui.view.editable.element.style.height = "200px"
                }).catch(function(e) {
                    console.error(e)
                })
            }), document.querySelectorAll(".snow-editor")),
            bubbleEditor = (snowEditor && Array.from(snowEditor).forEach(function(e) {
                var o = {};
                1 == e.classList.contains("snow-editor") && (o.theme = "snow", o.modules = {
                    toolbar: [
                        [{
                            font: []
                        }, {
                            size: []
                        }],
                        ["bold", "italic", "underline", "strike"],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            script: "super"
                        }, {
                            script: "sub"
                        }],
                        [{
                            header: [!1, 1, 2, 3, 4, 5, 6]
                        }, "blockquote", "code-block"],
                        [{
                            list: "ordered"
                        }, {
                            list: "bullet"
                        }, {
                            indent: "-1"
                        }, {
                            indent: "+1"
                        }],
                        ["direction", {
                            align: []
                        }],
                        ["link", "image", "video"],
                        ["clean"]
                    ]
                }), new Quill(e, o)
            }), document.querySelectorAll(".bubble-editor"));
        bubbleEditor && Array.from(bubbleEditor).forEach(function(e) {
            var o = {};
            1 == e.classList.contains("bubble-editor") && (o.theme = "bubble"), new Quill(e, o)
        });
    </script>
@endpush
