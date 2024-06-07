<?php

namespace App\Http\Controllers\rw;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KegiatanModel;
use App\Models\KeluargaModel;
use App\Models\RTModel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

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

        return view('rw.kegiatan.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'rt' => $rt]);
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

        return view('rw.kegiatan.create', ['breadcrumb' => $breadcrumb, 'page' => $page,'rt' => $rt,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'kegiatan_foto' => 'file|image|max:20000',
            'kegiatan_peserta' => 'required|max:6',
            'kegiatan_nama' => 'required|string|max:100',
            'kegiatan_lokasi' => 'required|string',
            'kegiatan_tanggal' => 'required|date|after_or_equal:today',
            'kegiatan_waktu' => 'required|date_format:H:i',
            'kegiatan_deskripsi' => 'required|string',
            'nominal' => 'required|integer|min:0',
        ], [
            'nominal.integer' => 'Input harus berupa bilangan bulat.',
        ]);

        if ($request->hasFile('kegiatan_foto')) {
            $file = $request->file('kegiatan_foto');
            $extfile = $file->extension();
            $hash = Str::random(40); // Generate a random hash
            $namaFile = $request->kegiatan_nama . '_' . $hash . '.' . $extfile;
    
            // Clean file name from unwanted characters
            $namaFile = preg_replace("/[^a-zA-Z0-9_.]/", '_', $namaFile);
    
            // Store file and get relative path
            $path = $file->storeAs('kegiatan_foto', $namaFile, 'public');
        } else {
            $path = null;
        }
        // dd(compact('request', 'path'));
        // $data = $request->except('_token');

        // // Ubah data menjadi query string
        // $queryString = http_build_query($data);

 
        $keluarga = KeluargaModel::all();
        

        $kelasAtasCount = 0;
        $kelasMenengahCount = 0;
        $kelasBawahCount = 0;
        
        // Hitung jumlah keluarga dalam setiap kelas ekonomi dan total iuran
        $totalIuran = $request->nominal;
        foreach ($keluarga as $keluarga) {
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
            $besaranIuranAtas = ($totalIuran * 0.5) / $kelasAtasCount;
        } else {
            $besaranIuranAtas = 0;
        }
        
        if ($kelasMenengahCount > 0) {
            $besaranIuranMenengah = ($totalIuran * 0.3) / $kelasMenengahCount;
        } else {
            $besaranIuranMenengah = 0;
        }
        
        if ($kelasBawahCount > 0) {
            $besaranIuranBawah = ($totalIuran * 0.2) / $kelasBawahCount;
        } else {
            $besaranIuranBawah = 0;
        }
        
     //   dd($keluarga);
        
        KegiatanModel::create([
            'kegiatan_peserta' => $request->kegiatan_peserta,
            'kegiatan_nama' => $request->kegiatan_nama,
            'kegiatan_lokasi' => $request->kegiatan_lokasi,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_waktu' => $request->kegiatan_waktu,
            'kegiatan_deskripsi' => $request->kegiatan_deskripsi,
            'foto' => $path,
          //  'total_biaya' => $request->nominal,
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
        $activeSubMenu = 'kegiatan_list';
        return view('rw.kegiatan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kegiatan' => $kegiatan, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
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
        $activeSubMenu = 'kegiatan_list';
        return view('rw.kegiatan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kegiatan' => $kegiatan,'rt'=>$rt, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
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
