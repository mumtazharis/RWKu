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
            @if($kegiatan[5])
            <a href="{{ asset('storage/' . $kegiatan[5]) }}" data-lightbox="kegiatan" data-title="{{ $kegiatan[0] }}">
                <img src="{{ asset('storage/' . $kegiatan[5]) }}" alt="{{ $kegiatan[0] }}" style="max-width: 200px; max-height: 200px;">
            </a>
            @else
                <p>Tidak ada foto.</p>
            @endif
        </td>
    </tr>
    {{-- $query = "$kegiatan_nama|$kegiatan_lokasi|$kegiatan_tanggal|$kegiatan_waktu|$kegiatan_deskripsi|$foto|$total_biaya"; --}}
    <tr>
        <th>Nama Kegiatan</th>
        <td>{{ $kegiatan[0] }}</td>
    </tr>
    <tr>
        <th>Lokasi Kegiatan</th>
        <td>{{ $kegiatan[1] }}</td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>{{ $kegiatan[2] }}</td>
    </tr>
    <tr>
        <th>Waktu</th>
        <td>{{ $kegiatan[3] }}</td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td>{{ $kegiatan[4] }}</td>
    </tr>
    <tr>
        <th>Total Biaya</th>
        <td>{{'Rp'. $kegiatan[6] }}</td>
    </tr>
</table>
@endempty
<a href="{{ url('rw/persetujuan') }}" class="btn btn-sm btn-default mt2">Kembali</a>
</div>
@if ($persetujuan->status == 'menunggu')
    <div class="card-footer text-right">
        <form id="actionForm" action="{{ url('rw/persetujuan/'.$persetujuan->persetujuan_id.'/keputusan') }}" method="POST" style="display: inline;">
            @csrf
            {!! method_field('PUT') !!}
            <input type="hidden" id="keputusan" name="keputusan" value="">
            <button type="button" class="btn btn-success btn-sm" onclick="confirmAction('disetujui')">Terima</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="confirmAction('ditolak')">Tolak</button>
        </form>
    </div>
    @endif
</div>

@endsection
@push('css')
@endpush
@push('js')
    <script>
         lightbox.option({
                    'resizeDuration': 200,
                    'fadeDuration': 200,
                    'imageFadeDuration': 200
                });

        function confirmAction(action) {
        var message;
        if (action === 'disetujui') {
            message = "Apakah Anda yakin ingin menerima?";
        } else if (action === 'ditolak') {
            message = "Apakah Anda yakin ingin menolak?";
        } else {
            message = "Apakah Anda yakin?";
        }
        if (confirm(message)) {
            document.getElementById('keputusan').value = action;
            document.getElementById('actionForm').submit();
        }
    }
    </script>
@endpush
