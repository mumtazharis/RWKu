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
        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kepemilikan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor KK</th>
                    <th>Penghasilan</th>
                    <th>Keluarga Ditanggung</th>
                    <th>Aksi</th>
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
        var dataKepemilikan = $('#table_kepemilikan').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            ajax: {
                url: "{{ url('rt/kepemilikan/list') }}", // Change url to route()
                type: "POST",
                data: function (d) {
                    d.kepemilikan_id = $('#kepemilikan_id').val();
                    d._token = '{{ csrf_token() }}'; // Add CSRF token
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
                    data: "keluarga.nomor_kk",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "penghasilan",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "keluarga_ditanggung",
                    className: "",
                    orderable: true,
                    searchable: true 
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false 
                }
            ]
        });

        $('#kepemilikan_id').on('change', function() {
            dataKepemilikan.ajax.reload(null, false);
        });
    });
</script>
@endpush
