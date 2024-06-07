@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm mt-1" href="{{ url('spk/mabac')}}" style="background-color: transparent; border: 1px solid #007bff; color: #007bff;">
                <i class="fas fa-chart-line"></i> Mabac
            </a>
            
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('spk/topsis')}}">
                <i class="fas fa-chart-bar"></i> Topsis
            </a>
            
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_spk">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor KK</th>
                    <th>Skor Mabac</th>
                    <th>Peringkat Mabac</th>
                    <th>Skor Topsis</th>
                    <th>Peringkat Topsis</th>
                </tr>
            </thead>
        </table>
        <a href="{{ url('kepemilikan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
<script>
    $(document).ready(function() {
        var dataSPK = $('#table_spk').DataTable({
            serverSide: true,
            pageLength: 25,
            ajax: {
                "url": "{{ url('spk/list') }}",
                "dataType": "json",
                "type": "POST"
                // "data": function (d){
                //     d.kegiatan_peserta = $('#kegiatan_peserta').val();
                // }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nomor_kk",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "skor_mabac",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "peringkat_mabac",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "skor_topsis",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "peringkat_topsis",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
            ]
        });

        // $('#kegiatan_peserta').on('change', function(){
        //     dataKegiatan.ajax.reload();
        // });
    });
</script>
@endpush 