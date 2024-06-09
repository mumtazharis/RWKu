<?php

namespace App\Http\Controllers\rt;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\KegiatanModel;
use App\Models\PersetujuanModel;
use App\Models\RTModel;
use App\Models\WargaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class RTIuranController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar iuran',
            'list' => ['Home', 'iuran']
        ];
        $page = (object)[
            'title' => 'Daftar iuran yang tedaftar dalam sistem'
        ];

        $user = Auth::user();
        $rt = WargaModel::where('nik', $user->username)->first();
        $activeMenu = 'kegiatan';
        $activeSubMenu = 'iuran_list';

        return view('rt.iuran.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'rt' => $rt]);
    }

    public function list(Request $request){
        $user = Auth::user();
        $rt = WargaModel::where('nik', $user->username)->first();
        $iurans = IuranModel::select('iuran.iuran_id', 'iuran.kegiatan_id', 'iuran.nomor_kk', 'iuran.nominal', 'iuran.status')
        ->join('keluarga', 'iuran.nomor_kk', '=', 'keluarga.nomor_kk') // Join dengan tabel keluarga
        ->where('keluarga.alamat_kk', $rt->rt) // Tambahkan kondisi where
        ->with('kegiatan')
        ->orderByRaw("FIELD(status,'belum lunas', 'menunggu', 'lunas' )")
        ->get();
    
        return DataTables::of($iurans)
            ->addIndexColumn()
            ->addColumn('aksi', function($iuran){
                $btn = '<a href="'.url('rt/iuran/'.$iuran->iuran_id).'" class="btn btn-info btn-sm">Detail</a>';
                        return $btn;
            })
            ->setRowAttr([
                'style' => function($persetujuan) {
                    if ($persetujuan->status === 'lunas') {
                        return 'background-color: #97ffaf;'; // Hijau muda untuk diterima
                    } elseif ($persetujuan->status === 'belum lunas') {
                        return 'background-color: #f8d7da;'; // Merah muda untuk ditolak
                    } elseif ($persetujuan->status === 'menunggu') {
                        return 'background-color: #fff3cd;'; // Kuning muda untuk menunggu
                    }
                    return '';
                }
            ])
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function listSaya(Request $request)
    {
        $user = Auth::user();
        
        $warga = WargaModel::where('nik', $user->username)->first();
    
        if (!$warga) {
            // Handle the case where warga is not found
            return response()->json(['error' => 'Warga not found'], 404);
        }
        
        $iurans = IuranModel::select('iuran.iuran_id', 'iuran.kegiatan_id', 'iuran.nomor_kk', 'iuran.nominal', 'iuran.status')
            ->with('kegiatan')
            ->where('iuran.nomor_kk', $warga->nomor_kk)
            ->orderByRaw("FIELD(status,'belum lunas', 'menunggu', 'lunas' )")
            ->get();
    
        return DataTables::of($iurans)
            ->addIndexColumn()
            ->addColumn('aksi', function($iuran){
                $btn = '<a href="'.url('rt/iuran/'.$iuran->iuran_id).'" class="btn btn-info btn-sm">Detail</a>';
                if ($iuran->status == 'belum lunas'){
                    $btn .= '<a href="'.url('rt/iuran/'.$iuran->iuran_id.'/bayar').'" class="btn btn-primary btn-sm">Bayar</a>';
                }
                return $btn;
            })
            ->setRowAttr([
                'style' => function($persetujuan) {
                    if ($persetujuan->status === 'lunas') {
                        return 'background-color: #97ffaf;'; // Hijau muda untuk diterima
                    } elseif ($persetujuan->status === 'belum lunas') {
                        return 'background-color: #f8d7da;'; // Merah muda untuk ditolak
                    } elseif ($persetujuan->status === 'menunggu') {
                        return 'background-color: #fff3cd;'; // Kuning muda untuk menunggu
                    }
                    return '';
                }
            ])
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function bayar(String $id){
        $iuran = IuranModel::find($id);
        if ($iuran){
            $kegiatan  = KegiatanModel::find($iuran->kegiatan_id);
        } else {
           return redirect('rt/iuran');
        }
 
        $breadcrumb = (object)[
            'title' => 'Pembayaran iuran',
            'list' => ['Home', 'iuran']
        ];
        $page = (object)[
            'title' => 'Lakukan pembayaran iuran'
        ];

        $activeMenu = 'kegiatan';
        $activeSubMenu = 'iuran_list';

        return view('rt.iuran.bayar', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu,'kegiatan' => $kegiatan, 'iuran' => $iuran]);
    }

    public function buktiPembayaran(Request $request, string $id){
        $request->validate([
            'bukti_pembayaran' => 'required|file|image|max:20000',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $extfile = $file->extension();
            $hash = Str::random(40); // Generate a random hash
            $namaFile = Carbon::now() . '_' . $hash . '.' . $extfile;
    
            // Clean file name from unwanted characters
            $namaFile = preg_replace("/[^a-zA-Z0-9_.]/", '_', $namaFile);
    
            // Store file and get relative path
            $path = $file->storeAs('bukti_pembayaran', $namaFile, 'public');
        } else {
            $path = null;
        }
        IuranModel::find($id)->update([
            'bukti_pembayaran' => $path,
            'status' => 'menunggu',
        ]);

        $user = Auth::user();
        
        PersetujuanModel::create([
            'user_id' => $user->user_id,
            'jenis' => 'iuran',
            'query' => $id,
            'keterangan' => 'Permintaan persetujuan bukti pembayaran iuran',
            'status' => 'menunggu',
        ]);

        return redirect('rt/iuran')->with('success', 'Data kegiatan berhasil diubah');
    }

    public function show(string $id){
        $iuran  = IuranModel::find($id);
        if ($iuran){
            $kegiatan = KegiatanModel::find($iuran->kegiatan_id);
        } else {
            return redirect('rt/iuran');
        }
        $breadcrumb = (object)[
            'title' => 'Detail iuran',
            'list' => ['Home', 'iuran', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail iuran'
        ];

        $activeMenu = 'kegiatan';
        $activeSubMenu = 'iuran_list';
        return view('rt.iuran.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'iuran' => $iuran,'kegiatan'=>$kegiatan, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }


    
}
