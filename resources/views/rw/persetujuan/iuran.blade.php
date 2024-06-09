@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($iuran)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
        @else
        <table class="table table-bordered table-striped table-hover tablesm mb-3">
            <tr>
                <th>Nomor KK</th>
                <td>{{ $iuran->nomor_kk }}</td>
            </tr>
            <tr>
                <th>Total Iuran</th>
                <td>{{ 'Rp' . $iuran->nominal }}</td>
            </tr>
            <tr>
                <th>Bukti Pembayaran</th>
                <td>
                    @if($iuran->bukti_pembayaran)
                    <a href="{{ asset('storage/' . $iuran->bukti_pembayaran) }}" data-lightbox="iuran" data-title="{{ $iuran->iuran_nama }}">
                        <img src="{{ asset('storage/' . $iuran->bukti_pembayaran) }}" alt="{{ $iuran->iuran_nama }}" style="max-width: 200px; max-height: 200px;">
                    </a>
                    @else
                        <p>Tidak ada foto.</p>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $persetujuan->status }}</td>
            </tr>
        </table>

        @endempty
        <a href="{{ url('rw/persetujuan') }}" class="btn btn-sm btn-default">Kembali</a>
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
