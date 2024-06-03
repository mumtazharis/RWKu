<?php

namespace App\Http\Controllers;

use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WargaController extends Controller
{
    // Menampilkan halaman awal level
    public function index()
    {
        // Set the breadcrumb data
        $breadcrumb = (object) [
            'title' => 'Daftar Warga',
            'list' => ['Home', 'Warga']
        ];

        // Set the page data
        $page = (object) [
            'title' => 'Daftar Warga yang terdaftar dalam sistem'
        ];

        // Set the active menu
        $activeMenu = 'warga';
        $activeSubMenu = 'warga_list';

        // Fetch warga data
        $warga = WargaModel::all();

        // Return the view with data
        return view('warga.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu,
            'warga' => $warga
        ]);
    }
// Ambil data level dalam bentuk json untuk datatables
public function list(Request $request)
{
    // Select specific columns from the DataWargaModel
    $dataWarga = WargaModel::select('nik', 'nomor_kk', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'alamat', 'rt', 'rw', 'kelurahan_desa', 'kecamatan', 'kabupaten_kota', 'provinsi', 'agama', 'pekerjaan','status_kependudukan');

    // Return data in DataTables format
    return DataTables::of($dataWarga)
        ->addIndexColumn() // Add index column (DT_RowIndex)
        ->addColumn('aksi', function ($warga) { // Add action column
            $btn = '<a href="' . url('/warga/' . $warga->nik) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/warga/' . $warga->nik . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            return $btn;
        })
        ->rawColumns(['aksi']) // Render HTML in the 'aksi' column
        ->make(true);
}
public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Warga Baru'
        ];

        $activeMenu = 'warga'; //set menu yang aktif
        $activeSubMenu = 'warga_list';

        return view('warga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu,]);
    }
    // Menyimpan data warga baru
    public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|string|min:3|',
        'nomor_kk' => 'nullable|string|max:100',
        'nama' => 'required|string|max:255',
        'tempat_lahir' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
        'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
        'golongan_darah' => 'nullable|string|max:2',
        'alamat' => 'nullable|string|max:255',
        'rt' => 'nullable|string|max:3',
        'rw' => 'nullable|string|max:3',
        'kelurahan_desa' => 'nullable|string|max:255',
        'kecamatan' => 'nullable|string|max:255',
        'kabupaten_kota' => 'nullable|string|max:255',
        'provinsi' => 'nullable|string|max:255',
        'agama' => 'nullable|string|max:50',
        'pekerjaan' => 'nullable|string|max:100',
    ]);

    WargaModel::create([
        'nik' => $request->nik,
        'nomor_kk' => $request->nomor_kk,
        'nama' => $request->nama,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'golongan_darah' => $request->golongan_darah,
        'alamat' => $request->alamat,
        'rt' => $request->rt,
        'rw' => $request->rw,
        'kelurahan_desa' => $request->kelurahan_desa,
        'kecamatan' => $request->kecamatan,
        'kabupaten_kota' => $request->kabupaten_kota,
        'provinsi' => $request->provinsi,
        'agama' => $request->agama,
        'pekerjaan' => $request->pekerjaan,
    ]);

    return redirect('/warga')->with('success', 'Data warga berhasil ditambahkan');
}
// Menampilkan detail warga
public function show($id)
{
    // Temukan data warga berdasarkan ID
    $warga = WargaModel::find($id);

    // Jika data warga ditemukan, lanjutkan untuk menampilkan halaman detail
    $breadcrumb = (object) [
        'title' => 'Detail Warga',
        'list' => ['Home', 'Warga', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail Warga'
    ];

    $activeMenu = 'warga'; // Set menu yang aktif
    $activeSubMenu = 'warga_list';

    return view('warga.show', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'warga' => $warga,
        'activeSubMenu' => $activeSubMenu,
        'activeMenu' => $activeMenu
    ]);
}
public function edit($id)
{
    // Temukan data warga berdasarkan ID
    $warga = WargaModel::find($id);

    // Jika data warga ditemukan, lanjutkan untuk menampilkan halaman detail
    $breadcrumb = (object) [
        'title' => 'Detail Warga',
        'list' => ['Home', 'Warga', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail Warga'
    ];

    $activeMenu = 'warga'; // Set menu yang aktif
    $activeSubMenu = 'warga_list';

    return view('warga.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'warga' => $warga,
        'activeSubMenu' => $activeSubMenu,
        'activeMenu' => $activeMenu
    ]);
}
public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|min:3|',
            'nomor_kk' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|string|max:2',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'kelurahan_desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten_kota' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'agama' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
        ]);

        WargaModel::find($id)->update([
            'nik' => $request->nik,
            'nomor_kk' => $request->nomor_kk,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'golongan_darah' => $request->golongan_darah,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan_desa' => $request->kelurahan_desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten_kota' => $request->kabupaten_kota,
            'provinsi' => $request->provinsi,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
        ]);

        return redirect('/warga')->with('success', 'Data warga berhasil diubah');
    }


}
