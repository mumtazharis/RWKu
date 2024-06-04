@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('keuangan/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_keuangan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penginput</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Pengeluaran Untuk</th>
                    <th>Pemasukan Dari</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
        </table>
        <div class="mt-3">
            <h5 class="text-right saldo-large">Saldo: <span id="saldo"></span></h5>
        </div>
    </div>
</div>
@endsection

@push('css')
<!-- Tambahkan CSS khusus di sini jika diperlukan -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataKeuangan = $('#table_keuangan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('keuangan/list') }}",
                type: "POST",
                data: function (d) {
                    d.penginput = $('#penginput').val();
                    d._token = '{{ csrf_token() }}';
                },
                error: function (xhr, error, code) {
                    console.log(xhr.responseText); // Log server response to console
                },
                dataSrc: function(json) {
                    $('#saldo').text(json.saldo); // Display saldo
                    return json.data;
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'penginput', orderable: true, searchable: true },
                { data: 'pemasukan', orderable: true, searchable: true },
                { data: 'pengeluaran', orderable: true, searchable: true },
                { data: 'pengeluaran_untuk', orderable: true, searchable: true },
                { data: 'pemasukan_dari', orderable: true, searchable: true },
                { data: 'tanggal', orderable: true, searchable: true }
            ],
            order: [[1, 'asc']]
        });

        $('#penginput').on('change', function() {
            dataKeuangan.ajax.reload(null, false);
        });
    });
</script>
@endpush
