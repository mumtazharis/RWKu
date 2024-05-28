<?php

namespace App\Http\Controllers;

use App\Models\KepemilikanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KepemilikanController extends Controller
{
    public function index()
    {
        // Set the breadcrumb data
        $breadcrumb = (object) [
            'title' => 'Daftar Kepimilikan',
            'list' => ['Home', 'Kepemilikan']
        ];

        // Set the page data
        $page = (object) [
            'title' => 'Daftar kepemilikan keluarga yang terdaftar dalam sistem'
        ];

        // Set the active menu
        $activeMenu = 'kepemilikan';
        $activeSubMenu = 'kepemilikan_list';

        // Fetch kepemilikan data
        $kepemilikan = KepemilikanModel::all();

        // Return the view with data
        return view('kepemilikan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu,
            'kepemilikan' => $kepemilikan
        ]);
    }
    public function list(Request $request)
{
    // Select specific columns from the KepemilikanModel
    $dataKepemilikan = KepemilikanModel::select( 'kepemilikan_id','penghasilan', 'keluarga_ditanggung', 'pajak_motor', 'pajak_mobil', 'pajak_bumi_bangunan', 'tagihan_air', 'tagihan_listrik', 'hutang');
    // Return data in DataTables format
    return DataTables::of($dataKepemilikan)
        ->addIndexColumn() // Add index column (DT_RowIndex)
        ->addColumn('aksi', function ($kepemilikan) { // Add action column
            $btn = '<a href="' . url('/kepemilikan/' . $kepemilikan->kepemilikan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/kepemilikan/' . $kepemilikan->kepemilikan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            return $btn;
        })
        ->rawColumns(['aksi']) // Render HTML in the 'aksi' column
        ->make(true);
}
public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kepemilikan',
            'list' => ['Home', 'Kepemilikan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Kepemilikan Baru'
        ];

        $activeMenu = 'kepemilikan'; //set menu yang aktif
        $activeSubMenu = 'kepemilikan_list';

        return view('kepemilikan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu,]);
    }
    public function store(Request $request)
{
    $request->validate([
        'kepemilikan_id' => 'required|integer',
        'penghasilan' => 'required|numeric',
        'keluarga_ditanggung' => 'required|integer',
        'pajak_motor' => 'nullable|numeric',
        'pajak_mobil' => 'nullable|numeric',
        'pajak_bumi_bangunan' => 'nullable|numeric',
        'tagihan_air' => 'nullable|numeric',
        'tagihan_listrik' => 'nullable|numeric',
        'hutang' => 'nullable|numeric',
    ]);

    KepemilikanModel::create([
        'kepemilikan_id' => $request->kepemilikan_id,
        'penghasilan' => $request->penghasilan,
        'keluarga_ditanggung' => $request->keluarga_ditanggung,
        'pajak_motor' => $request->pajak_motor,
        'pajak_mobil' => $request->pajak_mobil,
        'pajak_bumi_bangunan' => $request->pajak_bumi_bangunan,
        'tagihan_air' => $request->tagihan_air,
        'tagihan_listrik' => $request->tagihan_listrik,
        'hutang' => $request->hutang,
    ]);

    return redirect('/kepemilikan')->with('success', 'Data kepemilikan berhasil ditambahkan');
}
public function show($id)
{
    // Temukan data kepmilikan berdasarkan ID
    $kepemilikan = KepemilikanModel::find($id);

    // Jika data kepemilikan ditemukan, lanjutkan untuk menampilkan halaman detail
    $breadcrumb = (object) [
        'title' => 'Detail Kepemilikan',
        'list' => ['Home', 'Kepemilikan', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail Kepemilikan'
    ];

    $activeMenu = 'kepemilikan'; // Set menu yang aktif
    $activeSubMenu = 'kepemilikan_list';

    return view('kepemilikan.show', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'kepemilikan' => $kepemilikan,
        'activeSubMenu' => $activeSubMenu,
        'activeMenu' => $activeMenu
    ]);
}
public function edit($id)
{
   // Temukan data kepemilikna berdasarkan ID
   $kepemilikan = KepemilikanModel::find($id);

   // Jika data kepemilikan ditemukan, lanjutkan untuk menampilkan halaman detail
   $breadcrumb = (object) [
       'title' => 'Detail Kepemilikan',
       'list' => ['Home', 'Kepemilikan', 'Detail']
   ];

   $page = (object) [
       'title' => 'Detail Kepemilikan'
   ];

   $activeMenu = 'kepemilikan'; // Set menu yang aktif
   $activeSubMenu = 'kepemilikan_list';

   return view('kepemilikan.edit', [
       'breadcrumb' => $breadcrumb,
       'page' => $page,
       'kepemilikan' => $kepemilikan,
       'activeSubMenu' => $activeSubMenu,
       'activeMenu' => $activeMenu
   ]);
}
public function update(Request $request, $id)
    {
        $request->validate([
        'kepemilikan_id' => 'required|integer',
        'penghasilan' => 'required|numeric',
        'keluarga_ditanggung' => 'required|integer',
        'pajak_motor' => 'nullable|numeric',
        'pajak_mobil' => 'nullable|numeric',
        'pajak_bumi_bangunan' => 'nullable|numeric',
        'tagihan_air' => 'nullable|numeric',
        'tagihan_listrik' => 'nullable|numeric',
        'hutang' => 'nullable|numeric',
    ]);

    KepemilikanModel::create([
        'kepemilikan_id' => $request->kepemilikan_id,
        'penghasilan' => $request->penghasilan,
        'keluarga_ditanggung' => $request->keluarga_ditanggung,
        'pajak_motor' => $request->pajak_motor,
        'pajak_mobil' => $request->pajak_mobil,
        'pajak_bumi_bangunan' => $request->pajak_bumi_bangunan,
        'tagihan_air' => $request->tagihan_air,
        'tagihan_listrik' => $request->tagihan_listrik,
        'hutang' => $request->hutang,
    ]);

    return redirect('/kepemilikan')->with('success', 'Data kepemilikan berhasil diubah');
}


}
