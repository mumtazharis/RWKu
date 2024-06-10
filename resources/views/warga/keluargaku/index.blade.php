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
                    <table class="table table-bordered table-striped table-hover table-sm display nowrap" <thead>
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