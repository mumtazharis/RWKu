@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
<div class="card-body">
@empty($dataSPK)
<div class="alert alert-danger alert-dismissible">
    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
    Data yang Anda cari tidak ditemukan.
</div>
@else
<div>
    <p>1. Daftar Keiteria</p>
    <div class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
            <thead class="thead-light">
                <tr>
                    <th>Kriteria Benefit</th>
                    <th>Kriteria Cost</th>
                </tr>
            </thead>
            <tr>
                <td>Penghasilan</td>
                <td>Keluarga DItanggung</td>
            </tr>
            <tr>
                <td>Pajak Motor</td>
                <td>Hutang</td>
            </tr>
            <tr>
                <td>Pajak Mobil</td>
                <td></td>
            </tr>
            <tr>
                <td>Pajak Bumi Bangunan</td>
                <td></td>
            </tr>
            <tr>
                <td>Tagihan Air</td>
                <td></td>
            </tr>
            <tr>
                <td>Tagihan Listrik</td>
                <td></td>
            </tr>
            
        </table>
    </div>
    <p>2. Bobot Keiteria</p>
    <div class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light">
                <tr>
                    <th>Kriteria</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <tr>
                <td>Penghasilan</td>
                <td>{{$bobot[0]}}</td>
            </tr>
            <tr>
                <td>Pajak Motor</td>
                <td>{{$bobot[1]}}</td>
            </tr>
            <tr>
                <td>Pajak Mobil</td>
                <td>{{$bobot[2]}}</td>
            </tr>
            <tr>
                <td>Pajak Bumi Bangunan</td>
                <td>{{$bobot[3]}}</td>
            </tr>
            <tr>
                <td>Tagihan Air</td>
                <td>{{$bobot[4]}}</td>
            </tr>
            <tr>
                <td>Tagihan Listrik</td>
                <td>{{$bobot[5]}}</td>
            </tr>
            <tr>
                <td>Keluarga Ditanggung</td>
                <td>{{$bobot[6]}}</td>
            </tr>
            <tr>
                <td>hutang</td>
                <td>{{$bobot[7]}}</td>
            </tr>
            
        </table>
    </div>
    <p>3. Daftar Alternatif</p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th>Alternatif</th>
                </tr>
            </thead>
                @foreach ($dataSPK as $item)
                <tr>
                    <td>{{ $item->nomor_kk }}</td>
                </tr>
                @endforeach
        </table>
    </div>

    <p>4. Skor alternatif tiap kriteria</p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th>Alternatif</th>
                    <th>Penghasilan</th>
                    <th>Pajak Motor</th>
                    <th>Pajak Mobil</th>
                    <th>Pajak Bumi Bangunan</th>
                    <th>Tagihan Air</th>
                    <th>Tagihan Listrik</th>
                    <th>Keluarga Ditanggung</th>
                    <th>Hutang</th>
                </tr>
            </thead>
            @foreach ($dataSPK as $item)
            <tr>
                <td>{{ $item->nomor_kk }}</td>
                <td>{{ $item->penghasilan }}</td>
                <td>{{ $item->pajak_motor }}</td>
                <td>{{ $item->pajak_mobil }}</td>
                <td>{{ $item->pajak_bumi_bangunan }}</td>
                <td>{{ $item->tagihan_air }}</td>
                <td>{{ $item->tagihan_listrik }}</td>
                <td>{{ $item->keluarga_ditanggung }}</td>
                <td>{{ $item->hutang }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <p>5. Nilai min max tiap kriteria</p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th></th>
                    <th>Penghasilan</th>
                    <th>Pajak Motor</th>
                    <th>Pajak Mobil</th>
                    <th>Pajak Bumi Bangunan</th>
                    <th>Tagihan Air</th>
                    <th>Tagihan Listrik</th>
                    <th>Keluarga Ditanggung</th>
                    <th>Hutang</th>
                </tr>
            </thead>
            <tr>
                <td>Min</td>
                @foreach ($min as $item)
                <td>{{ $item }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Max</td>
                @foreach ($max as $item)
                <td>{{ $item }}</td>
                @endforeach
            </tr>
        </table>
    </div>

    <p>6. Normalisasi matriks keputusan (X) </p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th>Alternatif</th>
                    <th>Penghasilan</th>
                    <th>Pajak Motor</th>
                    <th>Pajak Mobil</th>
                    <th>Pajak Bumi Bangunan</th>
                    <th>Tagihan Air</th>
                    <th>Tagihan Listrik</th>
                    <th>Keluarga Ditanggung</th>
                    <th>Hutang</th>
                </tr>
            </thead>
            @foreach ($matriksX as $index=>$item)
            <tr>
                <td>{{ $item['nomor_kk'] }}</td>
                <td>{{ $item['penghasilan'] }}</td>
                <td>{{ $item['pajak_motor'] }}</td>
                <td>{{ $item['pajak_mobil'] }}</td>
                <td>{{ $item['pajak_bumi_bangunan'] }}</td>
                <td>{{ $item['tagihan_air'] }}</td>
                <td>{{ $item['tagihan_listrik'] }}</td>
                <td>{{ $item['keluarga_ditanggung'] }}</td>
                <td>{{ $item['hutang'] }}</td>
            </tr>
            @endforeach
            </tr>
        </table>
    </div>

    <p>6. Matriks tertimbang (V) </p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th>Alternatif</th>
                    <th>Penghasilan</th>
                    <th>Pajak Motor</th>
                    <th>Pajak Mobil</th>
                    <th>Pajak Bumi Bangunan</th>
                    <th>Tagihan Air</th>
                    <th>Tagihan Listrik</th>
                    <th>Keluarga Ditanggung</th>
                    <th>Hutang</th>
                </tr>
            </thead>
            @foreach ($matriksV as $index=>$item)
            <tr>
                <td>{{ $item['nomor_kk'] }}</td>
                <td>{{ $item['penghasilan'] }}</td>
                <td>{{ $item['pajak_motor'] }}</td>
                <td>{{ $item['pajak_mobil'] }}</td>
                <td>{{ $item['pajak_bumi_bangunan'] }}</td>
                <td>{{ $item['tagihan_air'] }}</td>
                <td>{{ $item['tagihan_listrik'] }}</td>
                <td>{{ $item['keluarga_ditanggung'] }}</td>
                <td>{{ $item['hutang'] }}</td>
            </tr>
            @endforeach
            </tr>
        </table>
    </div>

    <p>7. Matriks daerah perkiraan batas (G) </p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th></th>
                    <th>Penghasilan</th>
                    <th>Pajak Motor</th>
                    <th>Pajak Mobil</th>
                    <th>Pajak Bumi Bangunan</th>
                    <th>Tagihan Air</th>
                    <th>Tagihan Listrik</th>
                    <th>Keluarga Ditanggung</th>
                    <th>Hutang</th>
                </tr>
            </thead>
           
            <tr>
                <td>G</td>
                @foreach ($matriksG as $item)
                <td>{{ $item }}</td>
                @endforeach
            </tr>
       
            </tr>
        </table>
    </div>

    <p>8. Matriks jarak alternatif dari daerah perkiraan perbatasan (Q)</p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th>Alternatif</th>
                    <th>Penghasilan</th>
                    <th>Pajak Motor</th>
                    <th>Pajak Mobil</th>
                    <th>Pajak Bumi Bangunan</th>
                    <th>Tagihan Air</th>
                    <th>Tagihan Listrik</th>
                    <th>Keluarga Ditanggung</th>
                    <th>Hutang</th>
                </tr>
            </thead>
            @foreach ($matriksQ as $index=>$item)
            <tr>
                <td>{{ $item['nomor_kk'] }}</td>
                <td>{{ $item['penghasilan'] }}</td>
                <td>{{ $item['pajak_motor'] }}</td>
                <td>{{ $item['pajak_mobil'] }}</td>
                <td>{{ $item['pajak_bumi_bangunan'] }}</td>
                <td>{{ $item['tagihan_air'] }}</td>
                <td>{{ $item['tagihan_listrik'] }}</td>
                <td>{{ $item['keluarga_ditanggung'] }}</td>
                <td>{{ $item['hutang'] }}</td>
            </tr>
            @endforeach
            </tr>
        </table>
    </div>

    <p>9. Perankingan alternatif (S)</p>
    <div style="max-height: 350px; overflow-y: auto;" class="mb-3">
        <table class="table table-bordered table-striped table-hover tablesm">
             <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th>Alternatif</th>
                    <th>Skor</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            @foreach ($matriksS as $index=>$item)
            <tr>
                <td>{{ $item['nomor_kk'] }}</td>
                <td>{{ $item['nilai'] }}</td>
                <td>{{ $item['ranking'] }}</td>
            </tr>
            @endforeach
            </tr>
        </table>
    </div>
</div>



@endempty
<br>
<a href="{{ url('spk') }}" class="btn btn-sm btn-default mt2">Kembali</a>
</div>
</div>
@endsection
@push('css')
@endpush
