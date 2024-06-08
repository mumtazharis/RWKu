<?php

namespace App\Http\Controllers\warga;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KegiatanModel;
use App\Models\KeluargaModel;
use App\Models\RTModel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class WargaKegiatanController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar Kegiatan',
            'list' => ['Home', 'Kegiatan']
        ];
        $page = (object)[
            'title' => 'Daftar kegiatan yang tedaftar dalam sistem'
        ];

        $rt = RTModel::all();
        $activeMenu = 'kegiatan';
        $activeSubMenu = 'kegiatan_list';

        return view('warga.kegiatan.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'rt' => $rt]);
    }

    
    public function list(Request $request){
        $kegiatans = KegiatanModel::select('kegiatan_id', 'kegiatan_nama', 'kegiatan_lokasi', 'kegiatan_tanggal','kegiatan_waktu','kegiatan_deskripsi');
        
        return DataTables::of($kegiatans)
            ->addIndexColumn()
            ->addColumn('aksi', function($kegiatan){
                $btn = '<a href="'.url('warga/kegiatan/'.$kegiatan->kegiatan_id).'" class="btn btn-info btn-sm">Detail</a>';
             
                        return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(string $id){
        $kegiatan  = KegiatanModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Kegiatan',
            'list' => ['Home', 'Kegiatan', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail kegiatan'
        ];

        $activeMenu = 'kegiatan';
        $activeSubMenu = 'kegiatan_list';
        return view('warga.kegiatan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kegiatan' => $kegiatan, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }

}
