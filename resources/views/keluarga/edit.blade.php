@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($keluarga)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('keluarga') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
        <form method="POST" action="{{ url('keluarga/' . $keluarga->nomor_kk) }}" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-sm-2 control-label">Nomor KK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nomor_kk" value="{{ $keluarga->nomor_kk }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label">NIK Kepala Keluarga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik_kepala_keluarga" value="{{ $keluarga->nik_kepala_keluarga }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label">Alamat KK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat_kk" value="{{ $keluarga->alamat_kk }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label">Kelas Ekonomi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="kelas_ekonomi" value="{{ $keluarga->kelas_ekonomi }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label">Kepemilikan ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="kepemilikan_id" value="{{ $keluarga->kepemilikan_id }}">
                </div>
            </div>
            <!-- Add other fields based on your requirements -->
            <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('keluarga') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
