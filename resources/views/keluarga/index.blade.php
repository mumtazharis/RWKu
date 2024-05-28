@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('keluarga/create')}}">Tambah</a>
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
                        <select name="nomor_kk" id="nomor_kk" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach ($keluarga as $item)
                                <option value="{{ $item->nomor_kk }}">{{ $item->alamat_kk }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">RT</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_keluarga">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>NIK Kepala Keluarga</th>
                    <th>Alamat</th>
                    <th>Kelas Ekonomi</th>
                    <th>Kepemilikan ID</th>
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
        var dataKeluarga = $('#table_keluarga').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('keluarga/list') }}", // Change url to route()
                type: "POST",
                data: function (d) {
                    d.nomor_kk = $('#nomor_kk').val(); // change to nomor_kk
                    d._token = '{{ csrf_token() }}'; // Add CSRF token
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'nomor_kk', orderable: true, searchable: true },
                { data: 'nik_kepala_keluarga', orderable: true, searchable: true },
                { data: 'alamat_kk', orderable: true, searchable: true },
                { data: 'kelas_ekonomi', orderable: true, searchable: true },
                { data: 'kepemilikan_id', orderable: true, searchable: true },
                { data: 'aksi', orderable: false, searchable: false }
            ],
            order: [[1, 'asc']]
        });

        $('#nomor_kk').on('change', function() { // change to nomor_kk
            dataKeluarga.ajax.reload(null, false);
        });
    });
</script>
@endpush
