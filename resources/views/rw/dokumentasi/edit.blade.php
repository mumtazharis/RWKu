@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('rw/dokumentasi/'.$kegiatan->kegiatan_id) }}" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Kegiatan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_nama" name="kegiatan_nama" value="{{ $kegiatan->kegiatan_nama }}" readonly>
                    <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="{{ $kegiatan->kegiatan_id }}">
                    @error('kegiatan_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Foto Dokumentasi</label>
                <div class="col-11">
                    <!-- Display existing media -->
                    <div id="existingMedia" style="display: flex; flex-wrap: wrap;">
                        @foreach($kegiatan->dokumentasi as $media)
                            <div class="media-container" data-id="{{ $media->dokumentasi_id }}">
                                <img src="{{ asset('storage/' . $media->path) }}" alt="Media">
                                <button type="button" class="remove-existing-btn" data-id="{{ $media->dokumentasi_id }}">×</button>
                            </div>
                        @endforeach
                    </div>
                    <!-- Input for new media -->
                    <input type="file" class="form-control" id="dokumentasi_foto" name="dokumentasi_foto[]" accept="image/*" multiple onchange="previewMedia(event)" maxlength="1048576">
                    <div id="preview" style="display: flex; flex-wrap: wrap;"></div>
                    @error('dokumentasi_foto')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <!-- Hidden input for deleted media -->
            <!-- Hidden input for deleted media -->
            <input type="hidden" id="deleted_media" name="deleted_media" value="">


            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('rw/dokumentasi')}}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<style>
    .media-container {
        position: relative;
        display: inline-block;
        margin: 5px;
    }

    .media-container img {
        max-width: 200px;
        max-height: 200px;
        display: block;
    }

    .media-container p {
        text-align: center;
        margin: 5px 0 0 0;
        word-break: break-all;
        font-size: 12px;
    }

    .remove-existing-btn, .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 255, 255, 0.8);
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: '',
            allowClear: true
        });

        // Remove existing media with confirmation
        $('.remove-existing-btn').on('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus media ini?')) {
                var mediaId = $(this).data('id');
                var deletedMediaInput = $('#deleted_media');
                var deletedMedia = deletedMediaInput.val() ? deletedMediaInput.val().split(',') : [];
                deletedMedia.push(mediaId);
                deletedMediaInput.val(deletedMedia.join(','));

                // Hapus tampilan media dari halaman
                $(this).parent().remove();
            }
        });
    });

    function previewMedia(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('preview');

        // Clear existing previews if any
        previewContainer.innerHTML = '';

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = (function(file, index) {
                return function(e) {
                    var mediaContainer = document.createElement('div');
                    mediaContainer.classList.add('media-container');

                    var mediaElement = document.createElement('img');
                    mediaElement.src = e.target.result;
                    mediaElement.style.maxWidth = '200px';
                    mediaElement.style.maxHeight = '200px';

                    var fileNameElement = document.createElement('p');
                    fileNameElement.textContent = file.name;

                    mediaContainer.appendChild(mediaElement);
                    mediaContainer.appendChild(fileNameElement);
                    previewContainer.appendChild(mediaContainer);
                };
            })(file, i);

            reader.readAsDataURL(file);
        }
    }
</script>

@endpush
