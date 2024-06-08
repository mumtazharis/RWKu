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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <!-- Add any form inputs here if needed -->
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_keluarga">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>NIK</th>
                    <th>Nama</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
<!-- Tambahkan CSS khusus di sini jika diperlukan -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataKeluargaku = $('#table_warga').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('warga/keluargaku/list') }}", // Change url to route()
                type: "POST",
                data: function (d) {
                    d.nomor_kk = $('#nomor_kk').val(); // change to nomor_kk if needed
                    d._token = '{{ csrf_token() }}'; // Add CSRF token
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'nomor_kk', orderable: true, searchable: true },
                { data: 'nik', orderable: true, searchable: true },
                { data: 'nama', orderable: true, searchable: true }
            ],
            order: [[1, 'asc']]
        });

        $('#nomor_kk').on('change', function() { // change to nomor_kk if needed
            dataKeluargaku.ajax.reload(null, false);
        });
    });
</script>
@endpush
