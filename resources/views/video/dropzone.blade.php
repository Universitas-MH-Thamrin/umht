@extends('layouts.app')
@push('css')
    <!-- dropzone css -->
    <link rel="stylesheet" href="{{ asset('skote/assets/libs/dropzone/min/dropzone.min.css') }}" type="text/css" />
@endpush
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
                                    <a href="{{ route('dashboard.video.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                                <hr>

                                @include('components.flash_messages')

                                <form class="row g-3 needs-validation myForm" method="POST"
                                    action="{{ route('dashboard.video.update', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <label class="form-label">Dropzone Upload Video ke {{ $data->nama }}</label>
                                    </div>

                                    {{-- Dropzone Invoices --}}
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropzone">
                                                    <div class="fallback">
                                                        <form method="post"
                                                            action="{{ route('dashboard.video.fileStore', $data->id) }}"
                                                            enctype="multipart/form-data" class="dropzone" id="dropzone">
                                                            <input type="hidden" name="folder_id"
                                                                value="{{ $data->id }}">
                                                            @csrf
                                                            <input name="file" type="file" multiple="multiple">
                                                        </form>
                                                    </div>
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                        </div>

                                                        <h4>Unggah file disini jika lebih dari 1.</h4>
                                                    </div>
                                                </div>

                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                    @foreach ($videos as $item)
                                                        <li class="mt-2" id="dropzone-preview-list-existing">
                                                            <!-- This is used as the file preview template -->
                                                            <div class="border rounded">
                                                                <div class="d-flex p-2">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded">
                                                                            <img data-dz-thumbnail
                                                                                class="img-fluid rounded d-block"
                                                                                src="{{ ($item->file ? (MyHelper::is_image($item->file) ? url(Storage::url($item->file)) : asset('img/video.png'))  : asset('img/new-document.png')) }}"
                                                                                alt="{{ $item->nama }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <a href="{{ url(Storage::url($item->file)) }}"
                                                                            class="pt-1" target="_blank">
                                                                            <h5 class="fs-14 mb-1"
                                                                                data-dz-name="{{ $item->nama }}">
                                                                                {{ $item->nama }}
                                                                            </h5>
                                                                            <p class="fs-13 text-muted mb-0"
                                                                                data-dz-size="">
                                                                                {{ MyHelper::get_size($item->file) }}
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-3">
                                                                        <form
                                                                            action="{{ route('dashboard.video.fileDestroyReload') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="filename"
                                                                                value="{{ $item->nama }}">
                                                                            <button data-dz-remove
                                                                                class="btn btn-sm btn-danger"
                                                                                type="submit">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                    <li class="mt-2" id="dropzone-preview-list">
                                                        <!-- This is used as the file preview template -->
                                                        <div class="border rounded">
                                                            <div class="d-flex p-2">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-light rounded">
                                                                        <img data-dz-thumbnail
                                                                            class="img-fluid rounded d-block"
                                                                            src="{{ asset('img/new-document.png') }}"
                                                                            alt="Dropzone-Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                        <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                        <strong class="error text-danger"
                                                                            data-dz-errormessage></strong>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    <button data-dz-remove
                                                                        class="btn btn-sm btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
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
    <!-- dropzone min -->
    <script src="{{ asset('skote/assets/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script>
        var previewTemplate, dropzone, dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
        dropzonePreviewNode.id = "", dropzonePreviewNode && (previewTemplate = dropzonePreviewNode.parentNode.innerHTML,
            dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode), dropzone = new Dropzone(".dropzone", {
                url: "{{ route('dashboard.video.fileStore', $data->id) }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                previewTemplate: previewTemplate,
                previewsContainer: "#dropzone-preview",
                maxFilesize: 20,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + '_' + file.name;
                },
                acceptedFiles: ".mp4,.avi,.mov",
                timeout: 500000,
                removedfile: function(file) {
                    var filename = file.upload.filename;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('dashboard.video.fileDestroy') }}",
                        data: {
                            filename: filename
                        },
                        success: function(data) {
                            console.log(data);
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                success: function(file, response) {
                    console.log(response);
                },
                error: function(file, response) {
                    console.log(response);
                }
            }));
    </script>
@endpush
