@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('rt/keluarga/create')}}">Tambah</a>
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
                    <label class="col-1 control-label col-form-label">Filter RT:</label>
                    <div class="col-3">
                        <select name="alamat_kk" id="alamat_kk" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach ($alamat as $item)
                                <option value="{{ $item->rt_id }}">{{ $item->kode_rt }}</option>
                            @endforeach
                        </select>
      
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
                    <th>RT</th>
                    <th>Kelas Ekonomi</th>
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
            pageLength: 25,
            ajax: {
                url: "{{ url('rt/keluarga/list') }}", // Change url to route()
                type: "POST",
                data: function (d) {
                    d.alamat_kk = $('#alamat_kk').val(); // change to nomor_kk
                    d._token = '{{ csrf_token() }}'; // Add CSRF token
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'nomor_kk', orderable: true, searchable: true },
                { data: 'nik_kepala_keluarga', orderable: true, searchable: true },
                { data: 'alamat_kk', orderable: true, searchable: true },
                { data: 'kelas_ekonomi', orderable: true, searchable: true },
                { data: 'aksi', orderable: false, searchable: false }
            ],
            order: [[1, 'asc']]
        });

        $('#alamat_kk').on('change', function() { // change to nomor_kk
            dataKeluarga.ajax.reload(null, false);
        });
    });
</script>
@endpush
