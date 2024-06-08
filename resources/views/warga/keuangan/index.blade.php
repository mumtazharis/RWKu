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
        <div class="mt-3">
            <canvas id="financialChart" width="300" height="300"></canvas>
        </div>
    </div>
</div>
@endsection

@push('css')
<!-- Tambahkan CSS khusus di sini jika diperlukan -->
@endpush

@push('js')
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        var dataKeuangan = $('#table_keuangan').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            ajax: {
                url: "{{ url('warga/keuangan/list') }}",
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

                var totalPemasukan = json.data.reduce((acc, curr) => acc + parseFloat(curr.pemasukan), 0);
                var totalPengeluaran = json.data.reduce((acc, curr) => acc + parseFloat(curr.pengeluaran), 0);

                // Update pie chart with new data
                updatePieChart(totalPemasukan, totalPengeluaran);


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

        // Initialize pie chart
        var ctx = document.getElementById('financialChart').getContext('2d');
        var financialChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    label: 'Financial Data',
                    data: [0, 0],
                    backgroundColor: ['#4CAF50', '#F44336'],
                    borderColor: ['#388E3C', '#D32F2F'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        function updatePieChart(totalPemasukan, totalPengeluaran) {
        financialChart.data.datasets[0].data = [totalPemasukan, totalPengeluaran];
        financialChart.update();
    }
    });
</script>
@endpush
