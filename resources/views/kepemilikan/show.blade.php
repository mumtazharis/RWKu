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
            @else
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <tr>
                            <th>ID</th>
                            <td>{{ $kepemilikan->kepemilikan_id }}</td>
                        </tr>
                        <tr>
                            <th>Penghasilan</th>
                            <td>{{ $kepemilikan->penghasilan }}</td>
                        </tr>
                        <tr>
                            <th>Keluarga Ditanggung</th>
                            <td>{{ $kepemilikan->keluarga_ditanggung }}</td>
                        </tr>
                        <tr>
                            <th>Pajak Motor</th>
                            <td>{{ $kepemilikan->pajak_motor }}</td>
                        </tr>
                        <tr>
                            <th>Pajak Mobil</th>
                            <td>{{ $kepemilikan->pajak_mobil }}</td>
                        </tr>
                        <tr>
                            <th>Pajak Bumi dan Bangunan</th>
                            <td>{{ $kepemilikan->pajak_bumi_bangunan }}</td>
                        </tr>
                        <tr>
                            <th>Tagihan Air</th>
                            <td>{{ $kepemilikan->tagihan_air }}</td>
                        </tr>
                        <tr>
                            <th>Tagihan Listrik</th>
                            <td>{{ $kepemilikan->tagihan_listrik }}</td>
                        </tr>
                        <tr>
                            <th>Hutang</th>
                            <td>{{ $kepemilikan->hutang }}</td>
                        </tr>
                    </table>
                @endempty
                <a href="{{ url('kepemilikan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>        
@endsection

@push('css')
@endpush

@push('js')
@endpush