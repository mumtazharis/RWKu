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
        <th>Foto</th>
        <td>
            @if($kegiatan->foto)
                <a href="#" data-toggle="modal" data-target="#imageModal">
                <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->kegiatan_nama }}" style="max-width: 200px; max-height: 200px;">
                </a>
            @else
                <p>Tidak ada foto.</p>
            @endif
        </td>
    </tr>
    <tr>
        <th>ID</th>
        <td>{{ $kegiatan->kegiatan_id }}</td>
    </tr>
    <tr>
        <th>Peserta</th>
        
        <td>
            @if($kegiatan->kegiatan_peserta !== 'RW-5')
                {{ 'RT-' . $kegiatan->kegiatan_peserta }}
            @else
                RW-5
            @endif
        </td>
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

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Foto Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->kegiatan_nama }}" class="profile-img" style="width: 100%; max-width: none; height: auto;">
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
@endpush
