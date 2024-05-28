@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('kepemilikan/create')}}">Tambah</a>
        </div>
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
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select name="kepemilikan_id" id="kepemilikan_id" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach ($kepemilikan as $item)
                                <option value="{{ $item->kepemilikan_id }}">{{ $item->kepemilikan_id }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kepemilikan ID</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kepemilikan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
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
            ajax: {
                url: "{{ url('kepemilikan/list') }}", // Change url to route()
                type: "POST",
                data: function (d) {
                    d.kepemilikan_id = $('#kepemilikan_id').val();
                    d._token = '{{ csrf_token() }}'; // Add CSRF token
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'kepemilikan_id', orderable: true, searchable: true },
                { data: 'penghasilan', orderable: true, searchable: true },
                { data: 'keluarga_ditanggung', orderable: true, searchable: true },
                { data: 'aksi', orderable: false, searchable: false }
            ],
            order: [[1, 'asc']]
        });

        $('#kepemilikan_id').on('change', function() {
            dataKepemilikan.ajax.reload(null, false);
        });
    });
</script>
@endpush
