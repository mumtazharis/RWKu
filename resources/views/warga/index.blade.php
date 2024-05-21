@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('warga/create')}}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select name="nik" id="nik" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach ($warga as $item)
                                <option value="{{ $item->nik }}">{{ $item->rt }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">RT</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_warga">
            <thead>
                <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>No KK</th>
        <th>Alamat</th>
        <th>RT</th>
        <th>RW</th>
        <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div> @endsection

@push('css')
<!-- Tambahkan CSS khusus di sini jika diperlukan -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataWarga = $('#table_warga').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('warga/list') }}", // Change url to route()
                type: "POST",
                data: function (d) {
                    d.nik = $('#nik').val();
                    d._token = '{{ csrf_token() }}'; // Add CSRF token
                }
            },
            columns: [
            { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
            { data: 'nik', orderable: true, searchable: true },
            { data: 'nama', orderable: true, searchable: true },
            { data: 'nomor_kk', orderable: true, searchable: true },
            { data: 'alamat', orderable: true, searchable: true },
            { data: 'rt', orderable: true, searchable: true },
            { data: 'rw', orderable: true, searchable: true },
            { data: 'aksi', orderable: false, searchable: false }
            ],
            order: [[1, 'asc']]
        });

        $('#nik').on('change', function() {
            dataWarga.ajax.reload(null, false);
        });
    });
</script>
@endpush
