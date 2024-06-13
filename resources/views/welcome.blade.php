@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        @if(Auth::user()->level_id == 1)
        <h3 class="card-title">Halo, RW!!!</h3>
        @elseif (Auth::user()->level_id == 2)
        <h3 class="card-title">Halo, RT!!!</h3>
        @elseif (Auth::user()->level_id == 3)
        <h3 class="card-title">Halo, Warga!!!</h3>
        @endif
        <div class="card-tools"></div>
    </div> 
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        Selamat datang di Sistem Iuran Kegiatan Warga RW 05 Talun RWKu.
    </div>
    
    <div class="row card-body">
        <div class="col-md-4 mb-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="numbers">
                                <p class="card-category">Jumlah Warga</p>
                                <h4 class="card-title">{{ $totalWarga }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-list-alt"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="numbers">
                                <p class="card-category">Jumlah Kegiatan</p>
                                <h4 class="card-title">{{ $totalKegiatan }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-rupiah-sign"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="numbers">
                                <p class="card-category">Jumlah Uang Kas</p>
                                <h4 class="card-title">{{ $kas }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <div class="row card-body">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar"></i>
                        Jumlah warga
                    </h3>
                </div>
                <div class="card-body">
                    <div id="bar-chart" style="height: 400px; width: 400px; left:50px;"></div>
                </div>
                <!-- /.card-body-->
            </div>
        </div>
        <div class="col-md-8"> <!-- Menyesuaikan agar line chart memenuhi sisa space -->
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Jumlah kegiatan per bulan
                    </h3>
                </div>
                <div class="card-body">
                    <div id="line-chart" style="height: 400px; width: 900px;  left:50px;"></div>
                </div>
                <!-- /.card-body-->
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.js"></script>
    <script>
    $(function () {
        // Bar chart data
        var barData = [
            @foreach($data as $key => $value)
            [{{ $key + 1 }}, {{ $value }}],
            @endforeach
        ];

        // Line chart data
        var lineData = [
            @foreach($jumlahKegiatan as $key => $value)
            [{{ $key + 1 }}, {{ $value }}],
            @endforeach
        ];

        // Plotting both bar and line charts
        var plotObj = $.plot($('#bar-chart'), [{
            data: barData,
            bars: {
                show: true,
                barWidth: 0.8,
                align: 'center'
            },
        }], {
            // Bar chart options
            grid: {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor: '#f3f3f3'
            },
            series: {
                bars: {
                    show: true
                }
            },
            colors: ['#389deb'],
            xaxis: {
                ticks: [
                    @foreach($labels as $key => $label)
                    [{{ $key + 1 }}, '{{ $label }}'],
                    @endforeach
                ],
                axisLabel: 'RT',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10
            },
            yaxis: {
                axisLabel: 'Jumlah',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3,
                tickDecimals: 0,
            }
        });
                $('<div class="axisLabel xaxisLabel">RT</div>').appendTo($('#bar-chart')).css({
            position: 'absolute',
            left: ($('#bar-chart').width() - $('.xaxisLabel').width()) / 2,
            bottom: '-20px',
            left: '200px'
        });
        $('<div class="axisLabel yaxisLabel">Jumlah</div>').appendTo($('#bar-chart')).css({
            position: 'absolute',
            transform: 'rotate(-90deg)',
            top: ($('#bar-chart').height() - $('.yaxisLabel').height()) / 2,
            left: '-40px'
        });
        // Line chart options
        var lineOptions = {
            grid: {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor: '#f3f3f3'
            },
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            colors: ['#389deb'],
            xaxis: {
                ticks: [
                    @foreach($bulanLabels as $key => $label)
                    [{{ $key + 1 }}, '{{ $label }}'],
                    @endforeach
                ],
                axisLabel: 'Bulan',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10
            },
            yaxis: {
                axisLabel: 'Jumlah Kegiatan',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3,
                tickDecimals: 0,
            }
        };

        // Plot the line chart
        $.plot($('#line-chart'), [{
            data: lineData,
            lines: {
                show: true,
                lineWidth: 2,
            },
            points: {
                show: true,
                radius: 4
            }
        }], lineOptions);

        // Axis labels
        $('<div class="axisLabel xaxisLabel">Bulan</div>').appendTo($('#line-chart')).css({
            position: 'absolute',
            left: ($('#line-chart').width() - $('.xaxisLabel').width()) / 2,
            bottom: '-20px',
        });
        $('<div class="axisLabel yaxisLabel">Jumlah Kegiatan</div>').appendTo($('#line-chart')).css({
            position: 'absolute',
            transform: 'rotate(-90deg)',
            top: ($('#line-chart').height() - $('.yaxisLabel').height()) / 2,
            left: '-80px'
        });
    });
    </script>
@endpush
