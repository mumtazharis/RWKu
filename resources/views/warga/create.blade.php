@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('warga') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">NIK</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nik" name="nik"
                            value="{{ old('nik') }}" required>
                        @error('nik')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Nama</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ old('nama') }}" required>
                        @error('nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Nomor KK</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nomor_kk" name="nomor_kk"
                            value="{{ old('nomor_kk') }}" required>
                        @error('nomor_kk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Jenis Kelamin</label>
                    <div class="col-10">
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Alamat</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            value="{{ old('alamat') }}" required>
                        @error('alamat')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">RT</label>
                    <div class="col-10">
                        <select class="form-control" id="rt" name="rt">
                            <option value="">Pilih RT</option>
                            <option value="RT1">RT 1</option>
                            <option value="RT2">RT 2</option>
                            <option value="RT3">RT 3</option>
                            <option value="RT4">RT 4</option>
                        </select>
                        @error('rt')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Rw</label>
                    <div class="col-10">
                        <select class="form-control" id="rw" name="rw">
                            <option value="">Pilih RW</option>
                            <option value="RW5">RW 5</option>
                        </select>
                        @error('rt')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Kelurahan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="kelurahan_desa" name="kelurahan_desa"
                            value="{{ old('kelurahan_desa') }}" required>
                        @error('kelurahan_desa')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Kecamatan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                            value="{{ old('kecamatan') }}" required>
                        @error('kecamatan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Kabupaten/Kota</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="kabupaten_kota" name="kabupaten_kota"
                            value="{{ old('kabupaten_kota') }}" required>
                        @error('kabupaten_kota')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Provinsi</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="provinsi" name="provinsi"
                            value="{{ old('provinsi') }}" required>
                        @error('provinsi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Add other fields based on your requirements -->
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('warga') }}">Kembali</a>
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
