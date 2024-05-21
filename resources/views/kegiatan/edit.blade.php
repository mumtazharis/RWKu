@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
    @empty($kegiatan)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
        </div>
        <a href="{{ url('kegiatan') }}" class="btn btn-sm btn-default mt2">Kembali</a>
    @else
        <form method="POST" action="{{ url('/kegiatan/'.$kegiatan->kegiatan_id) }}" class="form-horizontal">
    @csrf
    {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Peserta</label>
                <div class="col-11">
                    <select class="form-control" id="kegiatan_peserta" name="kegiatan_peserta" required>
                        <option value="">- Pilih Peserta -</option>
                            <option value="RW" {{ old('kegiatan_peserta', $kegiatan->kegiatan_peserta ?? '') == 'RW' ? 'selected' : '' }}>Satu RW</option>
                            @foreach($rt as $item)
                                <option value="{{ $item->kode_rt }}" {{ old('kegiatan_peserta', $kegiatan->kegiatan_peserta ?? '') == $item->kode_rt ? 'selected' : '' }}>{{ $item->kode_rt}}</option>
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
                    <input type="text" class="form-control" id="kegiatan_nama" name="kegiatan_nama" value="{{ old('kegiatan_nama', $kegiatan->kegiatan_nama) }}" required>
                    @error('kegiatan_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Lokasi Kegiatan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_lokasi" name="kegiatan_lokasi" value="{{ old('kegiatan_lokasi', $kegiatan->kegiatan_lokasi) }}" required>
                    @error('kegiatan_lokasi')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Tanggal</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_tanggal" name="kegiatan_tanggal" value="{{ old('kegiatan_tanggal', $kegiatan->kegiatan_tanggal) }}" placeholder="Klik untuk memilih tanggal" required>
                    @error('kegiatan_tanggal')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Waktu</label>
                <div class="col-11">
                    <input type="time" class="form-control" id="kegiatan_waktu" name="kegiatan_waktu" value="{{ old('kegiatan_waktu', $kegiatan->kegiatan_waktu) }}" placeholder="Klik untuk memilih tanggal" required>
                    @error('kegiatan_waktu')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Deskripsi Kegiatan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kegiatan_deskripsi" name="kegiatan_deskripsi" value="{{ old('kegiatan_deskripsi', $kegiatan->kegiatan_deskripsi) }}" required>
                    @error('kegiatan_deskripsi')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Iuran</label>
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
        @endempty
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
@endpush