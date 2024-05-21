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
@else
<table class="table table-bordered table-striped table-hover tablesm">
    <tr>
        <th>ID</th>
        <td>{{ $kegiatan->kegiatan_id }}</td>
    </tr>
    <tr>
        <th>Peserta</th>
        <td>{{ $kegiatan->kegiatan_peserta }}</td>
    </tr>
    {{-- <tr>
        <th>Jumlah Peserta</th>
        <td>{{ $barang->kategori->kategori_nama }}</td>
    </tr> --}}
    <tr>
        <th>Nama Kegiatan</th>
        <td>{{ $kegiatan->kegiatan_nama }}</td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>{{ $kegiatan->kegiatan_tanggal }}</td>
    </tr>
    <tr>
        <th>Waktu</th>
        <td>{{ $kegiatan->kegiatan_waktu }}</td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td>{{ $kegiatan->kegiatan_deskripsi }}</td>
    </tr>
</table>
@endempty
<a href="{{ url('kegiatan') }}" class="btn btn-sm btn-default mt2">Kembali</a>
</div>
</div>
@endsection
@push('css')
@endpush
