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
                <label class="col-2 control-label col-form-label">Nomor KK</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="nomor_kk" name="nomor_kk"
                        value="{{ old('nomor_kk', $keluarga->nomor_kk) }}">
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
                            <option value="{{ $nik->nik }}" {{ old('nik_kepala_keluarga', $keluarga->nik_kepala_keluarga) == $nik->nik ? 'selected' : '' }}>
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
                            <option value="{{ $alamat->rt_id }}" {{ old('alamat_kk', $keluarga->alamat_kk) == $alamat->rt_id ? 'selected' : '' }}>
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
                            <option value="{{ $anggota->nik }}" 
                                {{ in_array($anggota->nik, old('anggota_keluarga', $anggotaKeluarga->pluck('nik')->toArray())) ? 'selected' : '' }}>
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
            
            <!-- Add other fields based on your requirements -->
            <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('keluarga') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </form>
        @endempty
    </div>
</div>
@endsection
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
