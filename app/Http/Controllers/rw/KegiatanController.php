<?php

namespace App\Http\Controllers\rw;
use App\Http\Controllers\Controller;
use App\Models\IuranModel;
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
        $kegiatans = KegiatanModel::select('kegiatan_id', 'kegiatan_nama', 'kegiatan_lokasi', 'kegiatan_tanggal','kegiatan_waktu','kegiatan_deskripsi');
        
        return DataTables::of($kegiatans)
            ->addIndexColumn()
            ->addColumn('aksi', function($kegiatan){
                $btn = '<a href="'.url('rw/kegiatan/'.$kegiatan->kegiatan_id).'" class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<a href="'.url('rw/kegiatan/'.$kegiatan->kegiatan_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a>';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('rw/kegiatan/'.$kegiatan->kegiatan_id).'">'
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

        $activeMenu = 'kegiatan';
        $activeSubMenu = 'kegiatan_list';

        return view('rw.kegiatan.create', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }

    public function store(Request $request){
        
        $request->validate([
            'kegiatan_foto' => 'file|image|max:20000',
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
 
        KegiatanModel::create([
            'kegiatan_nama' => $request->kegiatan_nama,
            'kegiatan_lokasi' => $request->kegiatan_lokasi,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_waktu' => $request->kegiatan_waktu,
            'kegiatan_deskripsi' => $request->kegiatan_deskripsi,
            'foto' => $path,
            'total_biaya' => $request->nominal,
        ]);


        $kelasKeluarga = KeluargaModel::all();
        

        $kelasAtasCount = 0;
        $kelasMenengahCount = 0;
        $kelasBawahCount = 0;
        
        // Hitung jumlah keluarga dalam setiap kelas ekonomi dan total iuran
        $totalIuran = $request->nominal;
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
        return redirect('rw/kegiatan')->with('success', 'Data kegiatan berhasil disimpan');
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

        $activeMenu = 'kegiatan';
        $activeSubMenu = 'kegiatan_list';
        return view('rw.kegiatan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kegiatan' => $kegiatan,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }


    public function update(Request $request, string $id){
        $request->validate([
            'kegiatan_nama' => 'required|string|max:100',
            'kegiatan_lokasi' => 'required|string',
            'kegiatan_tanggal' => 'required|date|after_or_equal:today',
            'kegiatan_waktu' => 'required|date_format:H:i',
            'kegiatan_deskripsi' => 'required|string',
            'nominal' => 'required|numeric|min:0',
        ]);

        KegiatanModel::find($id)->update([
            'kegiatan_nama' => $request->kegiatan_nama,
            'kegiatan_lokasi' => $request->kegiatan_lokasi,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_waktu' => $request->kegiatan_waktu,
            'kegiatan_deskripsi' => $request->kegiatan_deskripsi,
        ]);

        return redirect('rw/kegiatan')->with('success', 'Data kegiatan berhasil diubah');
    }


    public function destroy(string $id){
        $check = KegiatanModel::find($id);
        if(!$check){
            return redirect('rw/kegiatan')->with('error', 'Data kegiatan tidak ditemukan');
        }

        try{
            KegiatanModel::destroy($id);
            return redirect('rw/kegiatan')->with('success', 'Data kegiatan berhasil dihapus');
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect('rw/kegiatan')->with('error', 'Data kegiatan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
