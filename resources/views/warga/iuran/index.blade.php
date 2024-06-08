@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <h4>Iuran Keluarga Saya</h4>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_iuran_saya">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal kegiatan dilaksanakan</th>
                    <th>Beasaran iuran</th>
                    <th>Status</th>
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
        var dataIuransaya = $('#table_iuran_saya').DataTable({
            serverSide: true,
            pageLength: 10,
            ajax: {
                "url": "{{ url('warga/iuran/listSaya') }}",
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
                    data: "kegiatan.kegiatan_nama",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "kegiatan.kegiatan_tanggal",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
             
                {
                    data: "nominal",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "status",
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