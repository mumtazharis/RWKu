@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
 
        <div id="dataWrapper" class="mt-3">
            <!-- Data will be loaded here by JavaScript -->
        </div>
        <table class="table table-bordered table-striped table-hover table-sm d-none" id="table_dokumentasi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Dokumentasi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here by JavaScript -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
<style>
    .scrolling-wrapper {
        display: flex;
        flex-wrap: wrap;
        overflow-x: auto;
        max-height: 600px;
    }
    .scrolling-wrapper .card {
        flex: 0 0 auto;
        margin: 5px;
    }
    .scrolling-wrapper .card img {
        width: 100px;
        height: auto;
        cursor: pointer;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#table_dokumentasi').DataTable({
            searching: false,
            serverSide: true,
            pageLength: 5,
            lengthChange: false,
            ajax: {
                url: "{{ url('warga/dokumentasi/list') }}",
                type: "POST",
                data: function(d) {
                    d.kegiatan_peserta = $('#kegiatan_peserta').val();
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "kegiatan_nama", className: "", orderable: true, searchable: true },
                { data: "dokumentasi", className: "", orderable: false, searchable: false }
            ],
            drawCallback: function(settings) {
                var api = this.api();
                var data = api.rows({ page: 'current' }).data();

                var dataWrapper = $('#dataWrapper');
                dataWrapper.empty();

                data.each(function(row, index) {
                    var kegiatanHtml = '<div class="card">';
                    kegiatanHtml += '<div class="card-header bg-light d-flex justify-content-left align-items-center">';
                    kegiatanHtml += '<span>' + row.kegiatan_nama + '</span>';
            
                    kegiatanHtml += '</div>';
                    kegiatanHtml += '<div class="card-body">';
                    kegiatanHtml += '<div class="scrolling-wrapper">';

                    row.dokumentasi.forEach(function(photo) {
                        kegiatanHtml += '<div class="card" style="flex: 0 0 auto; margin-right: 0px;">';
                        kegiatanHtml += '<a href="' + photo.path + '" data-lightbox="kegiatan">';
                        kegiatanHtml += '<img src="' + photo.path + '" class="card-img-top" alt="..." style="width: 300px; height: auto;">';
                        kegiatanHtml += '</a>';
                        kegiatanHtml += '</div>';
                    });

                    kegiatanHtml += '</div>';
                    kegiatanHtml += '</div>';
                    kegiatanHtml += '</div>';
                    
                    dataWrapper.append('<div>' + kegiatanHtml + '</div>');
                });

                // Reinitialize Lightbox2
                lightbox.option({
                    'resizeDuration': 200,
                    'fadeDuration': 200,
                    'imageFadeDuration': 200
                });
            }
        });

        $('#kegiatan_peserta').on('change', function() {
            table.ajax.reload();
        });
    });
</script>
@endpush
