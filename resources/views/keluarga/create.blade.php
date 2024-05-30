@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('keluarga') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Nomor KK</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nomor_kk" name="nomor_kk"
                            value="{{ old('nomor_kk') }}">
                        @error('nomor_kk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">NIK Kepala Keluarga</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nik_kepala_keluarga" name="nik_kepala_keluarga"
                            value="{{ old('nik_kepala_keluarga') }}" required>
                        @error('nik_kepala_keluarga')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Alamat KK</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="alamat_kk" name="alamat_kk"
                            value="{{ old('alamat_kk') }}" required>
                        @error('alamat_kk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Kelas Ekonomi</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="kelas_ekonomi" name="kelas_ekonomi"
                            value="{{ old('kelas_ekonomi') }}" required>
                        @error('kelas_ekonomi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Add other fields based on your requirements -->
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('keluarga') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
