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
                            <a href="{{ route('dashboard.bank_data.index') }}" class="btn btn-warning"><i
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
                                    action="{{ route('dashboard.bank_data.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Bank Data</label>
                                        <input type="text" class="form-control" name="nama"
                                        value="{{ old('nama') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">File</label>
                                        <input type="file" class="form-control" name="file"
                                            value="{{ old('file') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Aktif ?</label>
                                        <select name="visible" id="visible" class="form-control" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="1" selected>Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
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
                ClassicEditor.create(document.querySelector(".ckeditor-classic")).then(function(e) {
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
