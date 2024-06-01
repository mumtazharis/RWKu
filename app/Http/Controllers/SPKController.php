<?php

namespace App\Http\Controllers;

use App\Models\KepemilikanModel;
use App\Models\SPKModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SPKController extends Controller
{
    public function index(){
        $this->mabac();
        $breadcrumb = (object)[
            'title' => 'Data SPK',
            'list' => ['']
        ];
        $page = (object)[
            'title' => 'Daftar SPK yang tedaftar dalam sistem'
        ];

        $activeMenu = 'warga';
        $activeSubMenu = 'kepemilikan_list';

        return view('kepemilikan.spk.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);

    }

    public function list(Request $request){
        $dataSPK = SPKModel::select('spk_id','nomor_kk', 'peringkat_mabac', 'peringkat_electre')
        ->join('kepemilikan', 'spk.kepemilikan_id', '=', 'kepemilikan.kepemilikan_id');
      
        return DataTables::of($dataSPK)
            ->addIndexColumn()
            ->make(true);
    }

    public function showMabac(){
        $result = $this->mabac();

        // Jika data kepemilikan ditemukan, lanjutkan untuk menampilkan halaman detail
        $breadcrumb = (object) [
            'title' => 'Detail Mabac',
            'list' => ['Home', 'Mabac', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Mabac'
        ];

        $activeMenu = 'warga'; // Set menu yang aktif
        $activeSubMenu = 'kepemilikan_list';

        // Mengakses data yang dikembalikan
        $dataSPK = $result['dataSPK'];
        $bobot = $result['bobot'];
        $min = $result['min'];
        $max = $result['max'];
        $matriksX = $result['matriksX'];
        $matriksV = $result['matriksV'];
        $matriksG = $result['matriksG'];
        $matriksQ = $result['matriksQ'];
        $matriksS = $result['matriksS'];
    return view('kepemilikan.spk.mabac', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'dataSPK' => $dataSPK,
        'bobot' => $bobot,
        'min' => $min,
        'max' => $max,
        'matriksX' => $matriksX,
        'matriksV' => $matriksV,
        'matriksG' => $matriksG,
        'matriksQ' => $matriksQ,
        'matriksS' => $matriksS,
        'activeSubMenu' => $activeSubMenu,
        'activeMenu' => $activeMenu
    ]);
       
    }

    public function mabac(){
        $dataSPK = KepemilikanModel::select('kepemilikan_id','nomor_kk', 'penghasilan', 'pajak_motor', 'pajak_mobil', 'pajak_bumi_bangunan', 'tagihan_air', 'tagihan_listrik', 'keluarga_ditanggung', 'hutang')->get();

        $bobot = [0.3, 0.1, 0.3, 0.05, 0.05, 0.05, 0.05, 0.1];
        
        $max = [];
        $min = [];
        $matriksX = [];
        $matriksV = [];
        $matriksG = [];
        $matriksQ = [];
        $matriksS = [];

        if ($dataSPK->isNotEmpty()) {
            $firstItem = $dataSPK->first();
            foreach ($firstItem->toArray() as $key => $value) {
                // Kolom kepemilikan_id dan nomor_kk tidak diikutsertakan dalam pencarian min dan max
                if ($key !== 'kepemilikan_id' && $key !== 'nomor_kk') {
                    $min[$key] = $value;
                    $max[$key] = $value;
                }
            }
    
            // Iterasi melalui setiap item dalam dataSPK
            foreach ($dataSPK as $item) {
                foreach ($item->toArray() as $key => $value) {
                    // Kolom kepemilikan_id dan nomor_kk tidak diikutsertakan dalam pencarian min dan max
                    if ($key !== 'kepemilikan_id' && $key !== 'nomor_kk') {
                        // Update nilai min dan max untuk kolom yang bersangkutan
                        if ($value < $min[$key]) {
                            $min[$key] = $value;
                        }
                        if ($value > $max[$key]) {
                            $max[$key] = $value;
                        }
                    }
                }
            }

            foreach ($dataSPK as $item) {
                $row = []; // Array untuk menyimpan baris matriks
                foreach ($item->toArray() as $key => $value) {
                    // Kondisi untuk kolom yang diinginkan
                    if ($key !== 'kepemilikan_id' && $key !== 'nomor_kk') {
                        if ($key !== 'keluarga_ditanggung' && $key !== 'hutang') {
                            // Normalisasi data untuk kriteria yang diinginkan
                            $row[$key] = ($value - $min[$key]) / ($max[$key] - $min[$key]);
                        } else {
                            // Normalisasi data untuk keluarga_ditanggung dan hutang (jika berbeda)
                            $row[$key] = ($value - $max[$key]) / ($min[$key] - $max[$key]);
                        }
                    } else {
                        // Tambahkan nilai asli untuk kepemilikan_id dan nomor_kk tanpa perubahan
                        $row[$key] = $value;
                    }
                }
                $matriksX[] = $row; // Tambahkan baris ke matriks
            }

            foreach ($matriksX as $row) {
                $rowV = [];
                $i = 0;
                foreach ($row as $key => $value) {
                    if ($key !== 'kepemilikan_id' && $key !== 'nomor_kk') {
                        $rowV[$key] = ($value * $bobot[$i]) + $bobot[$i];
                        $i++;
                    } else {
                        $rowV[$key] = $value; // Tidak mengubah kepemilikan_id dan nomor_kk
                    }
                }
                $matriksV[] = $rowV; // Tambahkan baris ke matriksV
            }

            $columns = array_keys($matriksV[0]);
            
            // Inisialisasi matriksG untuk kepemilikan_id dan nomor_kk dengan nilai asli
            foreach ($columns as $column) {
                if ($column === 'kepemilikan_id' || $column === 'nomor_kk') {
                    $matriksG[$column] = array_column($matriksV, $column); // Menyimpan nilai asli kolom
                }
            }
            
            // Menghitung hasil kali untuk kolom-kolom selain kepemilikan_id dan nomor_kk
            foreach ($columns as $column) {
                if ($column !== 'kepemilikan_id' && $column !== 'nomor_kk') {
                    $product = 1;
                    foreach ($matriksV as $row) {
                        $product *= $row[$column];
                    }
                    $matriksG[$column] = pow($product, 1/count($matriksV));
                }
            }
            unset($matriksG['kepemilikan_id'], $matriksG['nomor_kk']);

            foreach ($matriksV as $rowV) {
                $rowQ = [];
                foreach ($columns as $column) {
                    if ($column !== 'kepemilikan_id' && $column !== 'nomor_kk') {
                        $rowQ[$column] = $rowV[$column] - $matriksG[$column];
                    } else {
                        // Tambahkan nilai asli untuk kepemilikan_id dan nomor_kk tanpa perubahan
                        $rowQ[$column] = $rowV[$column];
                    }
                }
                $matriksQ[] = $rowQ; // Tambahkan baris ke matriksQ
            }

            foreach ($matriksQ as $rowQ) {
                $sum = 0;
                foreach ($rowQ as $key => $value) {
                    if ($key !== 'kepemilikan_id' && $key !== 'nomor_kk') {
                        $sum += $value;
                    }
                }
                $matriksS[] = [$rowQ['kepemilikan_id'], $rowQ['nomor_kk'],$sum ]; // Tambahkan hasil penjumlahan ke matriksS
            }

            array_multisort(array_column($matriksS, 2), SORT_DESC, $matriksS);
        
            // Menambahkan peringkat untuk setiap baris di matriksS
            foreach ($matriksS as $index => $row) {
                $matriksS[$index][] = $index + 1; // Menambahkan ranking
            }

        }
        
        $matriksData = [];

        foreach ($matriksS as $index => $row) {
            $matriksData[] = [
                'kepemilikan_id' => $row[0],
                'peringkat_mabac' => $row[3]
            ];
        
        }
        $uniqueBy = ['kepemilikan_id'];

        // Kolom yang akan di-update jika record sudah ada
        $updateColumns = ['peringkat_mabac'];
        
        SPKModel::upsert($matriksData, $uniqueBy, $updateColumns);

        return [
            'dataSPK' => $dataSPK,
            'bobot' => $bobot,
            'min' => $min,
            'max' => $max,
            'matriksX' => $matriksX,
            'matriksV' => $matriksV,
            'matriksG' => $matriksG,
            'matriksQ' => $matriksQ,
            'matriksS' => $matriksS
        ];
    }
}
