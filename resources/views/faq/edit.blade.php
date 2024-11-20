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
                                    <a href="{{ route('dashboard.faq.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.faq.update', $data->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <label class="form-label">Urutan</label>
                                        <input type="text" class="form-control" name="urutan"
                                            value="{{ $data->urutan }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Pertanyaan</label>
                                        <input type="text" class="form-control" name="pertanyaan"
                                            value="{{ $data->pertanyaan }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Jawaban</label>
                                        <textarea name="jawaban" id="jawaban" cols="30" rows="4" class="form-control ckeditor-classic">{{ $data->jawaban }}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Visible</label>
                                        <select name="visible" id="visible" class="form-control" required>
                                            <option value="">-- Pilih Visibilitas --</option>
                                            <option value="1" {{ $data->visible == 1 ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ $data->visible == 0 ? 'selected' : '' }}>Tidak
                                            </option>
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
