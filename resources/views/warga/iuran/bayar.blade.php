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

        <table class="table table-bordered table-striped table-hover tablesm mb-3">
            <tr>
                <th>Foto</th>
                <td>
                    @if($kegiatan->foto)
                    <a href="{{ asset('storage/' . $kegiatan->foto) }}" data-lightbox="kegiatan" data-title="{{ $kegiatan->kegiatan_nama }}">
                        <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->kegiatan_nama }}" style="max-width: 200px; max-height: 200px;">
                    </a>
                    @else
                        <p>Tidak ada foto.</p>
                    @endif
                </td>
            </tr>
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
        <table class="table table-bordered table-striped table-hover tablesm">
            <tr>
                <th>Nomor KK</th>
                <td>{{ $iuran->nomor_kk }}</td>
            </tr>
            <tr>
                <th>Total Iuran</th>
                <td>{{ 'Rp' . $iuran->nominal }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>
                    <ul class="list">
                        <li><strong>BRI:</strong> 206601016800505</li>
                        <li><strong>Gopay:</strong> 087822742996</li>
                        <li><strong>Dana:</strong> 087822742996</li>
                        <li><strong>Cash:</strong> Langsung ke rumah Pak RW</li>
                    </ul>
                </td>
            </tr>
        </table>

        <form action="{{ url('warga/iuran/'.$iuran->iuran_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {!! method_field('PUT') !!}
            <div class="form-group">
                <label for="buktiPembayaran">Unggah Bukti Pembayaran</label>
                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" onchange="previewImage(event)">
                <img id="preview" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;">
                @error('bukti_pembayaran')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex">
                <a href="{{ url('warga/iuran') }}" class="btn btn-sm btn-default">Kembali</a>
                <button type="submit" class="btn btn-sm btn-primary ml-1">Unggah</button>
            </div>
        </form>
        @endempty
    </div>
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
</script>
<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var img = document.getElementById('preview');
            img.src = reader.result;
            img.style.display = 'block'; // Menampilkan preview setelah file dipilih
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endpush
