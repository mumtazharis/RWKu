<?php

namespace App\Http\Controllers\rw;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\KegiatanModel;
use App\Models\KeluargaModel;
use App\Models\PersetujuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PersetujuanController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Daftar Persetujuan',
            'list' => ['Home', 'Persetujuan']
        ];

        // Set the page data
        $page = (object) [
            'title' => 'Daftar Persetujuan yang terdaftar dalam sistem'
        ];

        // Set the active menu
        $activeMenu = 'persetujuan';
        $activeSubMenu = '';

        // Fetch keluarga data
        $jenis = PersetujuanModel::all();

        // Return the view with data
        return view('rw.persetujuan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu,
            'jenis' => $jenis
        ]);
    }

    public function list(Request $request) {
        $query = PersetujuanModel::select('persetujuan.persetujuan_id', 'persetujuan.jenis', 'persetujuan.keterangan', 'persetujuan.query', 'persetujuan.status', 'warga.nama as warga_nama')
            ->join('user', 'persetujuan.user_id', '=', 'user.user_id')
            ->join('warga', 'user.username', '=', 'warga.nik');
    
        if ($request->jenis) {
            $query->where('persetujuan.jenis', $request->jenis);
        }
    
        $dataPersetujuan = $query
            ->orderByRaw("FIELD(status, 'menunggu', 'disetujui', 'ditolak')")
            ->get();
    
        // Return data in DataTables format
        return DataTables::of($dataPersetujuan)
            ->addIndexColumn() // Add index column (DT_RowIndex)
            ->addColumn('aksi', function ($persetujuan) {
                $btn = '<a href="'.url('rw/persetujuan/'.$persetujuan->persetujuan_id.'/'.$persetujuan->jenis).'" class="btn btn-info btn-sm">Periksa</a>';
                return $btn;
            })
            ->setRowAttr([
                'style' => function($persetujuan) {
                    if ($persetujuan->status === 'disetujui') {
                        return 'background-color: #97ffaf;'; // Hijau muda untuk diterima
                    } elseif ($persetujuan->status === 'ditolak') {
                        return 'background-color: #f8d7da;'; // Merah muda untuk ditolak
                    } elseif ($persetujuan->status === 'menunggu') {
                        return 'background-color: #fff3cd;'; // Kuning muda untuk menunggu
                    }
                    return '';
                }
            ])
            ->rawColumns(['aksi']) // Render HTML in the 'aksi' column
            ->make(true);
    }
    

    
    public function periksaIuran(String $id){
        $persetujuan = PersetujuanModel::find($id);
        $iuran = IuranModel::find($persetujuan->query);
        
        $breadcrumb = (object)[
            'title' => 'Periksa Bukti Pembayaran iuran',
            'list' => ['Home', 'periksa']
        ];
        $page = (object)[
            'title' => 'Periksa bukti pembayaran iuran'
        ];

        $activeMenu = 'persetujuan';
        $activeSubMenu = '';

        return view('rw.persetujuan.iuran', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'iuran' => $iuran, 'persetujuan'=>$persetujuan]);
    }

    public function periksaKegiatan(String $id){
        $breadcrumb = (object)[
            'title' => 'Periksa Kegiatan',
            'list' => ['Home', 'kegiatan']
        ];
        $page = (object)[
            'title' => 'Periksa permintaan pelaksanaan kegiatan'
        ];

        $activeMenu = 'persetujuan';
        $activeSubMenu = '';

        $persetujuan = PersetujuanModel::find($id);
        $kegiatan = explode('|', $persetujuan->query);
        return view('rw.persetujuan.kegiatan', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'persetujuan'=>$persetujuan, 'kegiatan' => $kegiatan]);
    }
    public function periksaKepemilikan(String $id){
        $persetujuan = PersetujuanModel::find($id);
        $iuran = IuranModel::find($persetujuan->query);
        
        $breadcrumb = (object)[
            'title' => 'Periksa Bukti Pembayaran iuran',
            'list' => ['Home', 'periksa']
        ];
        $page = (object)[
            'title' => 'Periksa bukti pembayaran iuran'
        ];

        $activeMenu = 'persetujuan';
        $activeSubMenu = '';

        return view('rw.persetujuan.iuran', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'iuran' => $iuran, 'persetujuan'=>$persetujuan]);
    }

    public function keputusan(Request $request, string $id){
     
        $request->validate([
            'keputusan' => 'required|in:disetujui,ditolak',
        ]);
        $status = PersetujuanModel::find($id);
        PersetujuanModel::find($id)->update([
            'status' => $request->keputusan,
        ]);

        $kegiatan = explode('|', $status->query);

        if ($request->keputusan == 'disetujui' ){
            if ($status->jenis == 'iuran'){
                IuranModel::find($status->query)->update([
                    'status' => 'lunas',
                ]);

            } elseif ($status->jenis == 'kegiatan'){
             
                //$query = "$kegiatan_nama|$kegiatan_lokasi|$kegiatan_tanggal|$kegiatan_waktu|$kegiatan_deskripsi|$foto|$total_biaya";
                KegiatanModel::create([
                    'kegiatan_nama' => $kegiatan[0],
                    'kegiatan_lokasi' => $kegiatan[1],
                    'kegiatan_tanggal' => $kegiatan[2],
                    'kegiatan_waktu' => $kegiatan[3],
                    'kegiatan_deskripsi' => $kegiatan[4],
                    'foto' => $kegiatan[5],
                    'total_biaya' => $kegiatan[6],
                ]);
        
        
                $kelasKeluarga = KeluargaModel::all();
                
        
                $kelasAtasCount = 0;
                $kelasMenengahCount = 0;
                $kelasBawahCount = 0;
                
                // Hitung jumlah keluarga dalam setiap kelas ekonomi dan total iuran
                $totalIuran = $kegiatan[6];
                foreach ($kelasKeluarga as $keluarga) {
                    $kelasEkonomi = $keluarga->kelas_ekonomi;
                    // Tambahkan jumlah keluarga dalam kelas ekonomi
                    if ($kelasEkonomi === 'atas') {
                        $kelasAtasCount++;
                    } elseif ($kelasEkonomi === 'menengah') {
                        $kelasMenengahCount++;
                    } elseif ($kelasEkonomi === 'bawah') {
                        $kelasBawahCount++;
                    }
                }
                
                // Hitung besaran iuran untuk setiap kelas ekonomi
                if ($kelasAtasCount > 0) {
                    // Bagi dengan 500, bulatkan ke atas, kemudian kalikan kembali dengan 500
                    $besaranIuranAtas = ceil(ceil(($totalIuran * 0.5) / $kelasAtasCount) / 500) * 500;
                } else {
                    $besaranIuranAtas = 0;
                }
        
                if ($kelasMenengahCount > 0) {
                    $besaranIuranMenengah = ceil(ceil(($totalIuran * 0.3) / $kelasMenengahCount) / 500) * 500;
                } else {
                    $besaranIuranMenengah = 0;
                }
        
                if ($kelasBawahCount > 0) {
                    $besaranIuranBawah = ceil(ceil(($totalIuran * 0.2) / $kelasBawahCount) / 500) * 500;
                } else {
                    $besaranIuranBawah = 0;
                }
        
           
                $kegiatan_id = KegiatanModel::latest()->first()->kegiatan_id;
                $listKeluarga = KeluargaModel::all();
                
                foreach ($listKeluarga as $keluarga){
                    IuranModel::create([
                        'kegiatan_id' => $kegiatan_id,
                        'nomor_kk' => $keluarga->nomor_kk,
                        'nominal' => $keluarga->kelas_ekonomi === 'atas' ? $besaranIuranAtas : ($keluarga->kelas_ekonomi === 'menengah' ? $besaranIuranMenengah : $besaranIuranBawah),
                        'status' => 'belum lunas',
                    ]);
                }
            }

        } elseif ($request->keputusan == 'ditolak' ){
            if ($status->jenis == 'iuran'){
                IuranModel::find($status->query)->update([
                    'status' => 'belum lunas',
                ]);
            } elseif ($status->jenis == 'kegiatan'){
                Storage::disk('public')->delete($kegiatan[5]);
            }
        }
       
        return redirect('rw/persetujuan')->with('success', 'Permintaan persetujuan berhasil diubah');
    }


}
