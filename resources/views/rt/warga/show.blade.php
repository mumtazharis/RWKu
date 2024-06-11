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
            @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>NIK</th>
                    <td>{{ $warga->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $warga->nama }}</td>
                </tr>
                <tr>
                    <th>Nomor KK</th>
                    <td>{{ $warga->nomor_kk }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $warga->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $warga->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $warga->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Golongan Darah</th>
                    <td>{{ $warga->golongan_darah }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $warga->alamat }}</td>
                </tr>
                <tr>
                    <th>RT</th>
                    <td>{{ $warga->rt }}</td>
                </tr>
                <tr>
                    <th>RW</th>
                    <td>{{ $warga->rw }}</td>
                </tr>
                <tr>
                    <th>Kelurahan/Desa</th>
                    <td>{{ $warga->kelurahan_desa }}</td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td>{{ $warga->kecamatan }}</td>
                </tr>
                <tr>
                    <th>Kabupaten/Kota</th>
                    <td>{{ $warga->kabupaten_kota }}</td>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td>{{ $warga->provinsi }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $warga->agama }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $warga->pekerjaan }}</td>
                </tr>
            </table>
            
            @endempty
            <a href="{{ url('rt/warga') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush