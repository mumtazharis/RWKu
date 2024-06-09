@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('rt/kegiatan/create')}}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kegiatan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
<script>
    $(document).ready(function() {
        var dataKegiatan = $('#table_kegiatan').DataTable({
            serverSide: true,
            pageLength: 25,
            ajax: {
                "url": "{{ url('rt/kegiatan/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d){
                    d.kegiatan_peserta = $('#kegiatan_peserta').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
           
                {
                    data: "kegiatan_nama",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "kegiatan_deskripsi",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "kegiatan_lokasi",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "kegiatan_tanggal",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "kegiatan_waktu",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false 
                },
            ]
        });

        $('#kegiatan_peserta').on('change', function(){
            dataKegiatan.ajax.reload();
        });
    });
</script>
@endpush 