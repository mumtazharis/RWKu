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
        Selamat datang di Sistem Iuran Kegiatan Warga RW 05 Talun RWKu.
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Data Warga</p>
                                <!-- Di sini Anda bisa menambahkan jumlah atau metrik lainnya -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-list-alt"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Data Kegiatan</p>
                                <!-- Di sini Anda bisa menambahkan jumlah atau metrik lainnya -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-list-alt"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Data Kegiatan</p>
                                <!-- Di sini Anda bisa menambahkan jumlah atau metrik lainnya -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection