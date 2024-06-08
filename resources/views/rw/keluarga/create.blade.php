@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('rw/keluarga') }}" class="form-horizontal">
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
                        <select class="form-control select2" id="nik_kepala_keluarga" name="nik_kepala_keluarga">
                            <option value=""></option>
                            @foreach($warga as $nik)
                                <option value="{{ $nik->nik }}" {{ old('nik_kepala_keluarga') == $nik->nik ? 'selected' : '' }}>
                                    {{ $nik->nik }} - {{$nik->nama}}
                                </option>
                            @endforeach
                        </select>
                        @error('nik_kepala_keluarga')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Alamat KK</label>
                    <div class="col-10">
                        <select class="form-control select2" id="alamat_kk" name="alamat_kk">
                            <option value=""></option>
                            @foreach($alamatkk as $alamat)
                                <option value="{{ $alamat->rt_id }}" {{ old('alamat_kk') == $alamat->rt_id ? 'selected' : '' }}>
                                    {{ $alamat->kode_rt }}
                                </option>
                            @endforeach
                        </select>
                        @error('alamat_kk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Anggota Keluarga</label>
                    <div class="col-10">
                        <select class="form-control select2" id="anggota_keluarga" name="anggota_keluarga[]" multiple>
                            <option value=""></option>
                            @foreach($warga as $anggota)
                                <option value="{{ $anggota->nik }}" {{ in_array($anggota->nik, old('anggota_keluarga', [])) ? 'selected' : '' }}>
                                    {{ $anggota->nik }} - {{ $anggota->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_keluarga')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        @foreach ($errors->get('anggota_keluarga.*') as $messages)
                            @foreach ($messages as $message)
                                <small class="form-text text-danger">{{ $message }}</small>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="card-header mb-3">
                    <div class="card-tools"></div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Penghasilan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="penghasilan" name="penghasilan"
                            value="{{ old('penghasilan') }}">
                        @error('penghasilan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Keluarga Ditanggung</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="keluarga_ditanggung" name="keluarga_ditanggung"
                            value="{{ old('keluarga_ditanggung') }}">
                        @error('keluarga_ditanggung')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pajak Motor</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pajak_motor" name="pajak_motor"
                            value="{{ old('pajak_motor') }}">
                        @error('pajak_motor')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pajak Mobil</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pajak_mobil" name="pajak_mobil"
                            value="{{ old('pajak_mobil') }}">
                        @error('pajak_mobil')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pajak Bumi dan Bangunan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pajak_bumi_bangunan" name="pajak_bumi_bangunan"
                            value="{{ old('pajak_bumi_bangunan') }}">
                        @error('pajak_bumi_bangunan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tagihan Air</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="tagihan_air" name="tagihan_air"
                            value="{{ old('tagihan_air') }}">
                        @error('tagihan_air')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tagihan Listrik</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="tagihan_listrik" name="tagihan_listrik"
                            value="{{ old('tagihan_listrik') }}">
                        @error('tagihan_listrik')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Hutang</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="hutang" name="hutang"
                            value="{{ old('hutang') }}">
                        @error('hutang')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('rw/keluarga') }}">Kembali</a>
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
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: '',
            allowClear: true
        });
    });
</script>

@endpush
