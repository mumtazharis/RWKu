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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter Jenis:</label>
                    <div class="col-3">
                        <select name="jenis" id="jenis" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->persetujuan_id }}">{{ $item->jenis }}</option>
                            @endforeach
                        </select>
      
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_persetujuan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dari</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
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
        var dataPersetujuan = $('#table_persetujuan').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            ajax: {
                url: "{{ url('rw/persetujuan/list') }}", // Change url to route()
                type: "POST",
                data: function (d) {
                    d.jenis = $('#jenis').val(); // change to nomor_kk
                    d._token = '{{ csrf_token() }}'; // Add CSRF token
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'warga_nama', orderable: true, searchable: true },
                { data: 'jenis', orderable: true, searchable: true },
                { data: 'keterangan', orderable: true, searchable: true },
                { data: 'status', orderable: false, searchable: true },
                { data: 'aksi', orderable: false, searchable: false }
            ],
        });

        $('#jenis').on('change', function() { // change to nomor_kk
            dataKeluarga.ajax.reload(null, false);
        });
    });
</script>
@endpush
