@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($warga)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('warga') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/warga/' . $warga->nik) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">NIK</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ old('nik', $warga->nik) }}" required>
                            @error('nik')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Nama</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $warga->nama) }}" required>
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Nomor KK</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="nomor_kk" name="nomor_kk"
                                value="{{ old('nomor_kk' , $warga->nomor_kk) }}" required>
                            @error('nomor_kk')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Tempat Lahir</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                value="{{ old('tempat_lahir' , $warga->tempat_lahir) }}" required>
                            @error('tempat_lahir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Tanggal Lahir</label>
                        <div class="col-10">
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir' , $warga->tanggal_lahir) }}" required>
                            @error('tanggal_lahir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Jenis Kelamin</label>
                        <div class="col-10">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                {{-- <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option> --}}
                                <option value="" {{ old('jenis_kelamin', $warga->jenis_kelamin) == '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ strtolower(old('jenis_kelamin', $warga->jenis_kelamin)) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ strtolower(old('jenis_kelamin', $warga->jenis_kelamin)) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Golongan Darah</label>
                        <div class="col-10">
                            <select class="form-control" id="golongan_darah" name="golongan_darah">
                                <option value="">Pilih Golongan Darah</option>
                                <option value="A" {{ strtolower(old('golongan_darah', $warga->golonngan_darah)) == 'a' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ strtolower(old('golongan_darah', $warga->golongan_darah)) == 'b' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ strtolower(old('golongan_darah', $warga->golongan_darah)) == 'ab' ? 'selected' : '' }}>AB</option>
                                <option value="0" {{ strtolower(old('golongan_darah', $warga->golongan_darah)) == 'o' ? 'selected' : '' }}>0</option>
                            </select>
                            @error('golongan_darah')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Alamat</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ old('alamat' , $warga->alamat) }}" required>
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
                                <option value="1" {{ (old('rt', $warga->rt)) == 1 ? 'selected' : '' }}>RT 1</option>
                                <option value="2" {{ (old('rt', $warga->rt)) == 2 ? 'selected' : '' }}>RT 2</option>
                                <option value="3" {{ (old('rt', $warga->rt)) == 3 ? 'selected' : '' }}>RT 3</option>
                                <option value="4" {{ (old('rt', $warga->rt)) == 4 ? 'selected' : '' }}>RT 4</option>
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
                                <option value="5" {{ (old('rw', $warga->rw)) == 5 ? 'selected' : '' }}>RW 5</option>
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
                                value="{{ old('kelurahan_desa' , $warga->kelurahan_desa) }}" required>
                            @error('kelurahan_desa' )
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Kecamatan</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                value="{{ old('kecamatan'  , $warga->kecamatan) }}" required>
                            @error('kecamatan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Kabupaten/Kota</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="kabupaten_kota" name="kabupaten_kota"
                                value="{{ old('kabupaten_kota' , $warga->kabupaten_kota) }}" required>
                            @error('kabupaten_kota'  )
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Provinsi</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="provinsi" name="provinsi"
                                value="{{ old('provinsi' , $warga->provinsi) }}" required>
                            @error('provinsi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Agama</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="agama" name="agama"
                                value="{{ old('agama' , $warga->agama) }}" required>
                            @error('agama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Pekerjaan</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                value="{{ old('pekerjaan' , $warga->pekerjaan) }}" required>
                            @error('pekerjaan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label"></label>
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
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
@endpush