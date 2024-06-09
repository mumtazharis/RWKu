@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('rt/dokumentasi') }}" class="form-horizontal" enctype="multipart/form-data">
        @csrf

            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Kegiatan</label>
                <div class="col-11">
                    <select class="form-control select2" id="kegiatan_id" name="kegiatan_id" required>
                        <option value=""></option>
                        @foreach($kegiatan as $key)
                            <option value="{{ $key->kegiatan_id }}" {{ old('kegiatan_id') == $key->kegiatan_id ? 'selected' : '' }}>
                                {{ $key->kegiatan_nama }} - {{$key->kegiatan_tanggal}}
                            </option>
                        @endforeach
                    </select>
                    @error('kegiatan_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Media</label>
                <div class="col-11">
                    <input type="file" class="form-control" id="dokumentasi_foto" name="dokumentasi_foto[]" accept="image/*" multiple onchange="previewMedia(event)" required maxlength="1048576">
                    <div id="preview" style="display: flex; flex-wrap: wrap;"></div>
                    @error('dokumentasi_foto')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('rt/dokumentasi')}}">Kembali</a>
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

    .remove-btn {
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

                    var removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.classList.add('remove-btn');
                    removeBtn.onclick = function() {
                        var dt = new DataTransfer();
                        var input = document.getElementById('dokumentasi_foto');
                        var files = Array.from(input.files);

                        files.splice(index, 1);

                        files.forEach(function(file) {
                            dt.items.add(file);
                        });

                        input.files = dt.files;

                        previewMedia({target: {files: input.files}});
                    };

                    mediaContainer.appendChild(mediaElement);
                    mediaContainer.appendChild(fileNameElement);
                    mediaContainer.appendChild(removeBtn);
                    previewContainer.appendChild(mediaContainer);
                };
            })(file, i);

            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
