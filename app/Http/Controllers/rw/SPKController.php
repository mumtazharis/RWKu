<?php

namespace App\Http\Controllers\rw;
use App\Http\Controllers\Controller;


use App\Models\KeluargaModel;
use App\Models\KepemilikanModel;
use App\Models\SPKModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SPKController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Data SPK',
            'list' => ['']
        ];
        $page = (object)[
            'title' => 'Daftar SPK yang tedaftar dalam sistem'
        ];

        $activeMenu = 'warga';
        $activeSubMenu = 'kepemilikan_list';

        return view('rw.kepemilikan.spk.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);

    }

    public function list(Request $request){

        $dataSPK = SPKModel::select('spk_id','nomor_kk', 'skor_mabac','peringkat_mabac', 'skor_topsis','peringkat_topsis')
        ->join('kepemilikan', 'spk.kepemilikan_id', '=', 'kepemilikan.kepemilikan_id');
        
        return DataTables::of($dataSPK)
            ->addIndexColumn()
            ->make(true);
    }

    public function runSPK(){
        $this->topsis();
        $this->mabac();
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

        return view('rw.kepemilikan.spk.mabac', [
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

    public function showTopsis(){
        $result = $this->topsis();

        // Jika data kepemilikan ditemukan, lanjutkan untuk menampilkan halaman detail
        $breadcrumb = (object) [
            'title' => 'Detail topsis',
            'list' => ['Home', 'topsis', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail topsis'
        ];

        $activeMenu = 'warga'; // Set menu yang aktif
        $activeSubMenu = 'kepemilikan_list';

        // Mengakses data yang dikembalikan
        $dataSPK = $result['dataSPK'];
        $bobot = $result['bobot'];
        $matriksR = $result['matriksR'];
        $matriksY = $result['matriksY'];
        $matriksAPositif = $result['matriksAPositif'];
        $matriksANegatif = $result['matriksANegatif'];
        $matriksDPositif = $result['matriksDPositif'];
        $matriksDNegatif = $result['matriksDNegatif'];
        $matriksS = $result['matriksS'];

        return view('rw.kepemilikan.spk.topsis', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'dataSPK' => $dataSPK,
            'bobot' => $bobot,
            'matriksR' => $matriksR,
            'matriksY' => $matriksY,
            'matriksAPositif' => $matriksAPositif,
            'matriksANegatif' => $matriksANegatif,
            'matriksDPositif' => $matriksDPositif,
            'matriksDNegatif' => $matriksDNegatif,
            'matriksS' => $matriksS,
            'activeSubMenu' => $activeSubMenu,
            'activeMenu' => $activeMenu
        ]);
       
    }

    public function mabac(){
        $dataSPK = KepemilikanModel::select('kepemilikan_id','nomor_kk', 'penghasilan', 'pajak_motor', 'pajak_mobil', 'pajak_bumi_bangunan', 'tagihan_air', 'tagihan_listrik', 'keluarga_ditanggung', 'hutang')->get();

        $bobot = [0.5, 0.05, 0.15, 0.05, 0.03, 0.07, 0.1, 0.05];
        
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
                $matriksS[] = [
                    'kepemilikan_id' => $rowQ['kepemilikan_id'],
                    'nomor_kk' => $rowQ['nomor_kk'],
                    'nilai' => $sum
                ];
                  //  $rowQ['kepemilikan_id'], $rowQ['nomor_kk'],$sum ]; // Tambahkan hasil penjumlahan ke matriksS
            }

            array_multisort(array_column($matriksS, 'nilai'), SORT_DESC, $matriksS);
        
            // Menambahkan peringkat untuk setiap baris di matriksS
            foreach ($matriksS as $index => $row) {
                $matriksS[$index]['ranking'] = $index + 1; // Menambahkan ranking
            }

        }
        
   
        $matriksData = [];
        $matriksKelas = [];
        foreach ($matriksS as $index => $row) {
            $matriksData[] = [
                'kepemilikan_id' => $row['kepemilikan_id'],
                'skor_mabac' => $row['nilai'],
                'peringkat_mabac' => $row['ranking']
            ];
            $matriksKelas[] = [
                'nomor_kk' => $row['nomor_kk'],
                'kelas_ekonomi' => ''
            ];
        
        }
        usort($matriksData, function ($a, $b) {
            return $a['peringkat_mabac'] <=> $b['peringkat_mabac'];
        });
        
        // Tentukan batas kelas
        $total = count($matriksData);
        $top30 = floor($total * 0.3);
        $middle60 = floor($total * 0.6);
        
        // Tambahkan kelas berdasarkan peringkat
        foreach ($matriksData as $index => $data) {
            if ($index < $top30) {
                $kelas = 'atas';
            } elseif ($index < $middle60) {
                $kelas = 'menengah';
            } else {
                $kelas = 'bawah';
            }
        
            // Cari elemen dengan 'kepemilikan_id' yang sama di $matriksKelas dan tambahkan 'kelas'
            foreach ($matriksS as $originalIndex => $originalRow) {
                if ($originalRow['kepemilikan_id'] == $data['kepemilikan_id']) {
                    $matriksKelas[$originalIndex]['kelas_ekonomi'] = $kelas;
                    break;
                }
            }
        }
        unset($data);

        // dd(compact('top30','middle60','matriksData', 'matriksKelas', 'matriksS'));
        $uniqueBy = ['kepemilikan_id'];

        // Kolom yang akan di-update jika record sudah ada
        $updateColumnsSPK = ['skor_mabac','peringkat_mabac'];
        
        SPKModel::upsert($matriksData, $uniqueBy, $updateColumnsSPK);
        $uniqueBy = ['nomor_kk'];
        $updateColumnsKeluarga = ['kelas_ekonomi'];

        KeluargaModel::upsert($matriksKelas, $uniqueBy, $updateColumnsKeluarga);
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

    public function topsis(){
        $dataSPK = KepemilikanModel::select('kepemilikan_id','nomor_kk', 'penghasilan', 'pajak_motor', 'pajak_mobil', 'pajak_bumi_bangunan', 'tagihan_air', 'tagihan_listrik', 'keluarga_ditanggung', 'hutang')->get();

       // print_r($dataSPK);

        $bobot = [0.5, 0.05, 0.15, 0.05, 0.03, 0.07, 0.1, 0.05];

        $matriksR = [];
        $matriksY = [];
        $matriksAPositif = []; 
        $matriksANegatif = []; 
        $matriksDPositif = []; 
        $matriksDNegatif = [];
        $matriksS = [];
        
        $columns = ['penghasilan', 'pajak_motor', 'pajak_mobil', 'pajak_bumi_bangunan', 'tagihan_air', 'tagihan_listrik', 'keluarga_ditanggung', 'hutang'];
            
        if ($dataSPK->isNotEmpty()) {
            $columnProducts = [];

          
            foreach ($columns as $column) {
                $product = 1;
                foreach ($dataSPK as $row) {
                    $product += pow($row->$column, 2);
                }
                $columnProducts[$column] = sqrt($product);
            }

            foreach ($dataSPK as $row) {
                $modifiedRow = $row->toArray();
                foreach ($columns as $column) {
                    if ($column !== 'keluarga_ditanggung' && $column !== 'hutang'){
                        $modifiedRow[$column] = $row->$column / $columnProducts[$column];
                    } else {
                        $modifiedRow[$column] = 1 - ($row->$column / $columnProducts[$column]);
                    }
              
                }
                $matriksR[] = $modifiedRow;
            }


            foreach ($matriksR as $row) {
                $rowY = [];
                $i = 0;
                foreach ($row as $key => $value) {
                    if ($key !== 'kepemilikan_id' && $key !== 'nomor_kk') {
                        $rowY[$key] = $value * $bobot[$i];
                        $i++;
                    } else {
                        $rowY[$key] = $value; // Tidak mengubah kepemilikan_id dan nomor_kk
                    }
                }
                $matriksY[] = $rowY; // Tambahkan baris ke matriksV
            }

        
            // Menghitung hasil kali untuk kolom-kolom selain kepemilikan_id dan nomor_kk
            foreach ($columns as $column) {
                if ($column !== 'kepemilikan_id' && $column !== 'nomor_kk') {
                    $matriksYcolumn = [];
                    foreach ($matriksY as $row) {
                        $matriksYcolumn[] = $row[$column];
                    }
                    $matriksAPositif[$column] = max($matriksYcolumn);
                    $matriksANegatif[$column] = min($matriksYcolumn);
                }
            }

            foreach ($matriksY as $rowY) {
                $productPositif = 0;
                $productNegatif = 0;
                foreach ($columns as $column) {
                    if ($column !== 'kepemilikan_id' && $column !== 'nomor_kk') {
                        $productPositif += pow($rowY[$column] - $matriksAPositif[$column], 2);
                        $productNegatif += pow($rowY[$column] - $matriksANegatif[$column], 2);
                    }
                }
                $matriksDPositif[] = [
                    'kepemilikan_id' => $rowY['kepemilikan_id'],
                    'nomor_kk' => $rowY['nomor_kk'],
                    'nilai' => sqrt($productPositif)
                ];
                $matriksDNegatif[] = [
                    'kepemilikan_id' => $rowY['kepemilikan_id'],
                    'nomor_kk' => $rowY['nomor_kk'],
                    'nilai' => sqrt($productNegatif)
                ];
            }

            foreach ($matriksDNegatif as $key => $value) {
                $matriksS[] = [
                    'kepemilikan_id' => $value['kepemilikan_id'],
                    'nomor_kk' => $value['nomor_kk'],
                    'nilai' => $value['nilai'] / ($matriksDPositif[$key]['nilai'] + $value['nilai'])
                ];
            }

            
            array_multisort(array_column($matriksS, 'nilai'), SORT_DESC, $matriksS);
        
            // Menambahkan peringkat untuk setiap baris di matriksS
            foreach ($matriksS as $index => $row) {
                $matriksS[$index]['ranking'] = $index + 1; // Menambahkan ranking
            }

            $matriksData = [];

            foreach ($matriksS as $index => $row) {
                $matriksData[] = [
                    'kepemilikan_id' => $row['kepemilikan_id'],
                    'skor_topsis' => $row['nilai'],
                    'peringkat_topsis' => $row['ranking']
                ];
            
            }
            $uniqueBy = ['kepemilikan_id'];
    
            // Kolom yang akan di-update jika record sudah ada
            $updateColumnsSPK = ['skor_topsis','peringkat_topsis'];
            
            SPKModel::upsert($matriksData, $uniqueBy, $updateColumnsSPK);
    
            return [
                'dataSPK' => $dataSPK,
                'bobot' => $bobot,
                'matriksR' => $matriksR,
                'matriksY' => $matriksY,
                'matriksAPositif' => $matriksAPositif,
                'matriksANegatif' => $matriksANegatif,
                'matriksDPositif' => $matriksDPositif,
                'matriksDNegatif' => $matriksDNegatif,
                'matriksS' => $matriksS
            ];
           // dd(compact('matriksR', 'matriksY', 'matriksAPositif', 'matriksANegatif', 'matriksDPositif', 'matriksDNegatif', 'matriksS'));
   
        }
    }
}
