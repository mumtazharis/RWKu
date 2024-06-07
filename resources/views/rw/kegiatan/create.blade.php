@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('kegiatan') }}" class="form-horizontal" enctype="multipart/form-data">
        @csrf
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Foto</label>
                <div class="col-11">
                    <input type="file" class="form-control" id="kegiatan_foto" name="kegiatan_foto" accept="image/*" onchange="previewImage(event)">
                    <img id="preview" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;">
                    @error('kegiatan_foto')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Peserta</label>
                <div class="col-11">
                    <select class="form-control" id="kegiatan_peserta" name="kegiatan_peserta" required>
                        <option value="">- Pilih Peserta -</option>
                            <option value="RW-5">Satu RW</option>
                            @foreach($rt as $item)
                                <option value="{{ $item->kode_rt }}">{{ $item->kode_rt}}</option>
                            @endforeach
                    </select>
                    @error('level_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Nama Kegiatan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_nama" name="kegiatan_nama" value="{{ old('kegiatan_nama') }}" required>
                    @error('kegiatan_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Lokasi Kegiatan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_lokasi" name="kegiatan_lokasi" value="{{ old('kegiatan_lokasi') }}" required>
                    @error('kegiatan_lokasi')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Tanggal</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_tanggal" name="kegiatan_tanggal" value="{{ old('kegiatan_tanggal') }}" placeholder="Klik untuk memilih tanggal" required>
                    @error('kegiatan_tanggal')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Waktu</label>
                <div class="col-11">
                    <input type="time" class="form-control" id="kegiatan_waktu" name="kegiatan_waktu" value="{{ old('kegiatan_waktu') }}" placeholder="Klik untuk memilih tanggal" required>
                    @error('kegiatan_waktu')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Deskripsi Kegiatan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_deskripsi" name="kegiatan_deskripsi" value="{{ old('kegiatan_deskripsi') }}" required>
                    @error('kegiatan_deskripsi')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Perkiraan Biaya</label>
                <div class="col-11">
                    <input type="number" class="form-control" id="nominal" name="nominal" value="{{ old('nominal') }}" required>
                    @error('nominal')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('kegiatan')}}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
<script>
    $(document).ready(function(){
        $('#kegiatan_tanggal').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var img = document.getElementById('preview');
            img.src = reader.result;
            img.style.display = 'block'; // Menampilkan preview setelah file dipilih
        };
        reader.readAsDataURL(input.files[0]);
    }
    </script>
@endpush
