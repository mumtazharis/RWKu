<?php

namespace App\Http\Controllers\warga;
use App\Http\Controllers\Controller;
use App\Models\DokumentasiModel;
use App\Models\KegiatanModel;
use App\Models\RTModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WargaDokumentasiController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Dokumentasi Kegiatan',
            'list' => ['Home', 'Dokumentasi']
        ];
        $page = (object)[
            'title' => 'Daftar dokumentasi kegiatan yang tedaftar dalam sistem'
        ];

        $rt = RTModel::all();
        $activeMenu = 'kegiatan';
        $activeSubMenu = 'dokumentasi_list';

        return view('warga.dokumentasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'rt' => $rt]);
    }

    public function list(Request $request){
        $data = KegiatanModel::with('dokumentasi')->select('kegiatan.*');
    
        if ($request->has('kegiatan_peserta') && $request->kegiatan_peserta != '') {
            $data->where('kegiatan_peserta', $request->kegiatan_peserta);
        }
    
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('dokumentasi', function($row) {
                $photosHtml = [];
                foreach ($row->dokumentasi as $photo) {
                    $photosHtml[] = [
                        'path' => asset('storage/' . $photo->path),
                    ];
                }
                return $photosHtml;
            })
            ->rawColumns(['dokumentasi'])
            ->toJson();
    }
}
