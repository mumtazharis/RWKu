<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanModel;
use App\Models\RTModel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
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

        return view('kegiatan.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'rt' => $rt]);
    }

    
    public function list(Request $request){
        $kegiatans = KegiatanModel::select('kegiatan_id', 'kegiatan_nama', 'kegiatan_lokasi', 'kegiatan_tanggal','kegiatan_waktu','kegiatan_deskripsi', 'kegiatan_peserta');
      
        if ($request->kegiatan_peserta){
            $kegiatans->where('kegiatan_peserta', $request->kegiatan_peserta);
        }
        
        return DataTables::of($kegiatans)
            ->addIndexColumn()
            ->addColumn('aksi', function($kegiatan){
                $btn = '<a href="'.url('/kegiatan/'.$kegiatan->kegiatan_id).'" class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<a href="'.url('/kegiatan/'.$kegiatan->kegiatan_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a>';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/kegiatan/'.$kegiatan->kegiatan_id).'">'
                        . csrf_field().method_field('DELETE').
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yakin menghapus data ini?\');">Hapus</button</form>';
                        return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Kegiatan',
            'list'  => ['Home', 'Kegiatan', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah kegiatan baru'
        ];

        $rt = RTModel::all();
        $activeMenu = 'kegiatan';
        $activeSubMenu = 'kegiatan_list';

        return view('kegiatan.create', ['breadcrumb' => $breadcrumb, 'page' => $page,'rt' => $rt,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'kegiatan_peserta' => 'required|max:6',
            'kegiatan_nama' => 'required|string|max:100',
            'kegiatan_lokasi' => 'required|string',
            'kegiatan_tanggal' => 'required|date|after_or_equal:today',
            'kegiatan_waktu' => 'required|date_format:H:i',
            'kegiatan_deskripsi' => 'required|string',
            'nominal' => 'required|numeric|min:0',
        ]);

        KegiatanModel::create([
            'kegiatan_peserta' => $request->kegiatan_peserta,
            'kegiatan_nama' => $request->kegiatan_nama,
            'kegiatan_lokasi' => $request->kegiatan_lokasi,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_waktu' => $request->kegiatan_waktu,
            'kegiatan_deskripsi' => $request->kegiatan_deskripsi,
        ]);

        return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil disimpan');
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
        return view('kegiatan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kegiatan' => $kegiatan, 'activeMenu' => $activeMenu]);
    }


    public function edit(string $id){
        $kegiatan  = KegiatanModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit kegiatan',
            'list' => ['Home', 'kegiatan', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit kegiatan'
        ];

        $rt = RTModel::all();

        $activeMenu = 'kegiatan';
        return view('kegiatan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kegiatan' => $kegiatan,'rt'=>$rt, 'activeMenu' => $activeMenu]);
    }


    public function update(Request $request, string $id){
        $request->validate([
            'kegiatan_peserta' => 'required|max:6',
            'kegiatan_nama' => 'required|string|max:100',
            'kegiatan_lokasi' => 'required|string',
            'kegiatan_tanggal' => 'required|date|after_or_equal:today',
            'kegiatan_waktu' => 'required|date_format:H:i',
            'kegiatan_deskripsi' => 'required|string',
            'nominal' => 'required|numeric|min:0',
        ]);

        KegiatanModel::find($id)->update([
            'kegiatan_peserta' => $request->kegiatan_peserta,
            'kegiatan_nama' => $request->kegiatan_nama,
            'kegiatan_lokasi' => $request->kegiatan_lokasi,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_waktu' => $request->kegiatan_waktu,
            'kegiatan_deskripsi' => $request->kegiatan_deskripsi,
        ]);

        return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil diubah');
    }


    public function destroy(string $id){
        $check = KegiatanModel::find($id);
        if(!$check){
            return redirect('/kegiatan')->with('error', 'Data kegiatan tidak ditemukan');
        }

        try{
            KegiatanModel::destroy($id);
            return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil dihapus');
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect('/kegiatan')->with('error', 'Data kegiatan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
