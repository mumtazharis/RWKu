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
@else
<table class="table table-bordered table-striped table-hover tablesm mb-3">
    <tr>
        <th>Nomor KK</th>
        <td>{{ $keluarga->nomor_kk }}</td>
    </tr>
    <tr>
        <th>Alamat KK</th>
        <td>{{ $alamat->kode_rt }}</td>
    </tr>
    <tr>
        <th>Nik Kepala Keluarga</th>
        <td>{{ $keluarga->nik_kepala_keluarga }}</td>
    </tr>
    <tr>
        <th>Nama Kepala Keluarga</th>
        <td>
            @foreach ($warga as $wargaItem)
                @if ($wargaItem->nik == $keluarga->nik_kepala_keluarga)
                    {{ $wargaItem->nama }}
                    @break
                @endif
            @endforeach
        </td>
    </tr>
    
   
    
</table>
<table class="table table-bordered table-striped table-hover tablesm mb-3">
    <tr>
        <th>NIK Anggota Keluarga</th>
        <th>Nama Anggota Keluarga</th>
    </tr>
    @foreach ($warga as $wargaItem)
       
        <tr>
            <td>
                {{ $wargaItem->nik }}
            </td>
            <td>
                {{ $wargaItem->nama }}
            </td>
        
        </tr>
            
           
        
    @endforeach

</table>
<p>Kepemilikan</p>
<table class="table table-bordered table-striped table-hover tablesm mb-3">
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
<a href="{{ url('rt/keluarga') }}" class="btn btn-sm btn-default mt2">Kembali</a>
</div>
</div>
@endsection
@push('css')
@endpush
