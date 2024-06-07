<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiModel;
use App\Models\KegiatanModel;
use App\Models\RTModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumentasiController extends Controller
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

        return view('dokumentasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'rt' => $rt]);
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
    
    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Dokumentasi Kegiatan',
            'list'  => ['Home', 'Dokumentasi', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Dokumentasi kegiatan baru'
        ];

        $kegiatan = KegiatanModel::all();
        $activeMenu = 'kegiatan';
        $activeSubMenu = 'dokumentasi_list';

        return view('dokumentasi.create', ['breadcrumb' => $breadcrumb, 'page' => $page,'kegiatan' => $kegiatan ,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }

    public function store(Request $request){
   
        $request->validate([
            'dokumentasi_foto.*' => 'required|file|image|max:20000',
            'kegiatan_id' => 'required|exists:kegiatan,kegiatan_id',
        ]);
    

        if ($request->hasFile('dokumentasi_foto')) {
            foreach ($request->file('dokumentasi_foto') as $file) {
                $extfile = $file->extension();
                $hash = Str::random(40); // Generate a random hash
                $namaFile = $request->kegiatan_id . '_' . $hash . '.' . $extfile;

                // Clean file name from unwanted characters
                $namaFile = preg_replace("/[^a-zA-Z0-9_.]/", '_', $namaFile);

                // Store file and get relative path
                $path = $file->storeAs('dokumentasi', $namaFile, 'public');

                DokumentasiModel::create([
                    'kegiatan_id' => $request->kegiatan_id,
                    'path' => $path,
                    'tanggal' => now(),
                ]);
            }
        }

        return redirect('/dokumentasi')->with('success', 'Data kegiatan berhasil disimpan');
    }


    public function edit(string $id){
        $dokumentasi  = DokumentasiModel::where('kegiatan_id', $id)->get();
        $kegiatan  = KegiatanModel::find($id);
        $breadcrumb = (object)[
            'title' => 'Edit dokumentasi kegiatan',
            'list' => ['Home', 'Dokumentasi', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit dokumentasi kegiatan'
        ];

    

        $activeMenu = 'kegiatan';
        $activeSubMenu = 'dokumentasi_list';
        return view('dokumentasi.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kegiatan' => $kegiatan, 'dokumentasi' => $dokumentasi,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'dokumentasi_foto.*' => 'required|file|image|max:20000',
            'kegiatan_id' => 'required|exists:kegiatan,kegiatan_id',
        ]);

        // Temukan kegiatan berdasarkan ID
        $kegiatan = KegiatanModel::findOrFail($id);

        // Handle penghapusan media
        if ($request->has('deleted_media')) {
            $deletedMediaIds = explode(',', $request->input('deleted_media'));
            foreach ($deletedMediaIds as $mediaId) {
                $media = DokumentasiModel::find($mediaId);
                if ($media) {
                    // Hapus file dari storage
                    Storage::delete('public/' . $media->path);
                    // Hapus data dari database
                    $media->delete();
                }
            }
        }

        // Handle upload media baru
        if ($request->hasFile('dokumentasi_foto')) {
            foreach ($request->file('dokumentasi_foto') as $file) {
                $extfile = $file->extension();
                $hash = Str::random(40); // Generate a random hash
                $namaFile = $request->kegiatan_id . '_' . $hash . '.' . $extfile;

                // Clean file name from unwanted characters
                $namaFile = preg_replace("/[^a-zA-Z0-9_.]/", '_', $namaFile);

                // Store file and get relative path
                $path = $file->storeAs('dokumentasi', $namaFile, 'public');

                DokumentasiModel::create([
                    'kegiatan_id' => $request->kegiatan_id,
                    'path' => $path,
                    'tanggal' => now(),
                ]);
            }

         
        }

        return redirect('dokumentasi')->with('success', 'Data berhasil diperbarui!');
    }
    
}
