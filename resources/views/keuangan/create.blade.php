@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('keuangan') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Penginput</label>
                    <div class="col-10">
                        <!-- Input field untuk menampilkan nama pengguna -->
                        <input type="text" class="form-control" id="penginput_nama" name="penginput_nama"
                               value="{{ $warga->nama }}" readonly>
                        
                        <!-- Input field tersembunyi untuk mengirimkan NIK -->
                        <input type="hidden" id="penginput" name="penginput" value="{{ $warga->nik }}">
                        
                        @error('penginput')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pemasukan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pemasukan" name="pemasukan"
                            value="{{ old('pemasukan')?? 0 }}">
                        @error('pemasukan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pengeluaran</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pengeluaran" name="pengeluaran"
                            value="{{ old('pengeluaran') ?? 0 }}">
                        @error('pengeluaran')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pengeluaran Untuk</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pengeluaran_untuk" name="pengeluaran_untuk"
                            value="{{ old('pengeluaran_untuk')}}">
                        @error('pengeluaran_untuk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pemasukan Dari</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pemasukan_dari" name="pemasukan_dari"
                            value="{{ old('pemasukan_dari') }}">
                        @error('pemasukan_dari')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tanggal</label>
                    <div class="col-10">
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('keuangan') }}">Kembali</a>
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
