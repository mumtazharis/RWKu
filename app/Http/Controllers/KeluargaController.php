<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    public function index()
    {
        // Set the breadcrumb data
        $breadcrumb = (object) [
            'title' => 'Daftar Keluarga',
            'list' => ['Home', 'Keluarga']
        ];

        // Set the page data
        $page = (object) [
            'title' => 'Daftar Keluarga yang terdaftar dalam sistem'
        ];

        // Set the active menu
        $activeMenu = 'warga';
        $activeSubMenu = 'keluarga_list';

        // Fetch keluarga data
        $keluarga = KeluargaModel::all();

        // Return the view with data
        return view('keluarga.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu,
            'keluarga' => $keluarga
        ]);
    }
    public function list(Request $request) {
        // Select specific columns from the KeluargaModel
        $dataKeluarga = KeluargaModel::select('nomor_kk','nik_kepala_keluarga', 'alamat_kk', 'kelas_ekonomi');
        // Return data in DataTables format
        return DataTables::of($dataKeluarga)
            ->addIndexColumn() // Add index column (DT_RowIndex)
            ->addColumn('aksi', function ($keluarga) { // Add action column
                $btn = '<a href="' . url('/keluarga/' . $keluarga->nomor_kk . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Render HTML in the 'aksi' column
            ->make(true);
    }
    
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Keluarga',
            'list' => ['Home', 'Keluarga', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Keluarga Baru'
        ];

        $activeMenu = 'keluarga'; //set menu yang aktif
        $activeSubMenu = 'keluarga_list';

        return view('keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu,]);
    }
    public function store(Request $request)
{
    $request->validate([
        'nomor_kk' => 'required|integer',
        'nik_kepala_keluarga' => 'required|numeric',
        'alamat_kk' => 'required|string',
        'kelas_ekonomi' => 'required|string',

    ]);

    KeluargaModel::create([
        'nomor_kk' => $request->nomor_kk,
        'nik_kepala_keluarga' => $request->nik_kepala_keluarga,
        'alamat_kk' => $request->alamat_kk,
        'kelas_ekonomi' => $request->kelas_ekonomi,
       
    ]);

    return redirect('/keluarga')->with('success', 'Data keluarga berhasil ditambahkan');
}
public function edit($id)
{
   // Temukan data kepemilikna berdasarkan ID
   $keluarga = KeluargaModel::find($id);

   // Jika data keluarga$keluarga ditemukan, lanjutkan untuk menampilkan halaman detail
   $breadcrumb = (object) [
       'title' => 'Detail Keluarga',
       'list' => ['Home', 'Keluarga', 'Detail']
   ];

   $page = (object) [
       'title' => 'Detail Keluarga'
   ];

   $activeMenu = 'keluarga'; // Set menu yang aktif
   $activeSubMenu = 'keluarga_list';

   return view('keluarga.edit', [
       'breadcrumb' => $breadcrumb,
       'page' => $page,
       'keluarga' => $keluarga,
       'activeSubMenu' => $activeSubMenu,
       'activeMenu' => $activeMenu
   ]);
}
public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kk' => 'required|integer',
            'nik_kepala_keluarga' => 'required|numeric',
            'alamat_kk' => 'required|string',
            'kelas_ekonomi' => 'required|string',
      
        ]);
    
        KeluargaModel::find($id)->update([
            'nomor_kk' => $request->nomor_kk,
            'nik_kepala_keluarga' => $request->nik_kepala_keluarga,
            'alamat_kk' => $request->alamat_kk,
            'kelas_ekonomi' => $request->kelas_ekonomi,

        ]);
    
        // if ($request->has('kepemilikan_id')) {
        //     $data['kepemilikan_id'] = $request->kepemilikan_id;
        // }
        return redirect('/keluarga')->with('success', 'Data kepemilikan berhasil diubah');
    }

}
