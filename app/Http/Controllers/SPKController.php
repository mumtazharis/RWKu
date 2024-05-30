<?php

namespace App\Http\Controllers;

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

        return view('kepemilikan.spk.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);

    }

    public function list(Request $request){
        $dataSPK = SPKModel::select('spk_id','nomor_kk', 'peringkat_mabac', 'peringkat_electre')
        ->join('kepemilikan', 'spk.kepemilikan_id', '=', 'kepemilikan.kepemilikan_id');
      
        return DataTables::of($dataSPK)
            // ->addIndexColumn()
            // ->addColumn('aksi', function($kegiatan){
            //     $btn = '<a href="'.url('/kegiatan/'.$kegiatan->kegiatan_id).'" class="btn btn-info btn-sm">Detail</a>';
            //     $btn .= '<a href="'.url('/kegiatan/'.$kegiatan->kegiatan_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a>';
            //     $btn .= '<form class="d-inline-block" method="POST" action="'.url('/kegiatan/'.$kegiatan->kegiatan_id).'">'
            //             . csrf_field().method_field('DELETE').
            //             '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yakin menghapus data ini?\');">Hapus</button</form>';
            //             return $btn;
            // })
            // ->rawColumns(['aksi'])
            // ->make(true);
            ->addIndexColumn()
            ->make(true);
    }
}
