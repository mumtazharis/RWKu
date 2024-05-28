@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($kepemilikan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('kepemilikan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/kepemilikan/' . $kepemilikan->kepemilikan_id) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Kepemilikan ID</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="kepemilikan_id" name="kepemilikan_id"
                                value="{{ old('kepemilikan_id', $kepemilikan->kepemilikan_id) }}" required>
                            @error('kepemilikan_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Penghasilan</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="penghasilan" name="penghasilan"
                                value="{{ old('penghasilan', $kepemilikan->penghasilan) }}" required>
                            @error('penghasilan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Keluarga Ditanggung</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="keluarga_ditanggung" name="keluarga_ditanggung"
                                value="{{ old('keluarga_ditanggung', $kepemilikan->keluarga_ditanggung) }}" required>
                            @error('keluarga_ditanggung')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Pajak Motor</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="pajak_motor" name="pajak_motor"
                                value="{{ old('pajak_motor', $kepemilikan->pajak_motor) }}" required>
                            @error('pajak_motor')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Pajak Mobil</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="pajak_mobil" name="pajak_mobil"
                                value="{{ old('pajak_mobil', $kepemilikan->pajak_mobil) }}" required>
                            @error('pajak_mobil')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Pajak Bumi dan Bangunan</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="pajak_bumi_bangunan" name="pajak_bumi_bangunan"
                                value="{{ old('pajak_bumi_bangunan', $kepemilikan->pajak_bumi_bangunan) }}" required>
                            @error('pajak_bumi_bangunan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Tagihan Air</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="tagihan_air" name="tagihan_air"
                                value="{{ old('tagihan_air', $kepemilikan->tagihan_air) }}" required>
                            @error('tagihan_air')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Tagihan Listrik</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="tagihan_listrik" name="tagihan_listrik"
                                value="{{ old('tagihan_listrik', $kepemilikan->tagihan_listrik) }}" required>
                            @error('tagihan_listrik')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Hutang</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="hutang" name="hutang"
                                value="{{ old('hutang', $kepemilikan->hutang) }}" required>
                            @error('hutang')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label"></label>
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('kepemilikan') }}">Kembali</a>
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
