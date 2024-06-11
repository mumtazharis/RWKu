@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
                <h5 class="card-title">Data Keluarga </h5>
                <div class="table-responsive">
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
                                @foreach ($keluargaku as $wargaItem)
                                    @if ($wargaItem->nik == $keluarga->nik_kepala_keluarga)
                                        {{ $wargaItem->nama }}
                                        @break
                                    @endif
                                @endforeach
                            </td>
                        </tr>    
                    </table>
                    <h5 class="card-title">Data Anggota keluarga </h5>

                    <table class="table table-bordered table-striped table-hover table-sm display nowrap mb-3">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($keluargaku as $keluarga)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $keluarga->nik }}</td>
                                    <td>{{ $keluarga->nama }}</td>
                                    <td>{{ $keluarga->tempat_lahir }}</td>
                                    <td>{{ $keluarga->tanggal_lahir }}</td>
                                    <td>{{ $keluarga->agama }}</td>
                                    <td>{{ $keluarga->jenis_kelamin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5 class="card-title">Data Kepemilikan Keluarga </h5>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush