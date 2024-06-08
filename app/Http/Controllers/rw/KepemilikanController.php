<?php

namespace App\Http\Controllers\rw;
use App\Http\Controllers\Controller;


use App\Models\KeluargaModel;
use App\Models\KepemilikanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\rw\SPKController;

class KepemilikanController extends Controller
{
    private $spkController;
    public function __construct(SPKController $spkController)
    {
        $this->spkController = $spkController;
    }
    public function index()
    {
        // Set the breadcrumb data
        $breadcrumb = (object) [
            'title' => 'Daftar Kepemilikan',
            'list' => ['Home', 'Kepemilikan']
        ];

        // Set the page data
        $page = (object) [
            'title' => 'Daftar kepemilikan keluarga yang terdaftar dalam sistem'
        ];

        // Set the active menu
        $activeMenu = 'warga';
        $activeSubMenu = 'kepemilikan_list';

        // Fetch kepemilikan data
        $kepemilikan = KepemilikanModel::all();

        // Return the view with data
        return view('rw.kepemilikan.index', [
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
    $dataKepemilikan = KepemilikanModel::select('kepemilikan_id','nomor_kk','penghasilan', 'keluarga_ditanggung', 'pajak_motor', 'pajak_mobil', 'pajak_bumi_bangunan', 'tagihan_air', 'tagihan_listrik', 'hutang')
                                            ->with('keluarga');
    // // Return data in DataTables format
    // $dataKepemilikan = KeluargaModel::select('nomor_kk', 'kepemilikan_id')->with('kepemilikan');

    return DataTables::of($dataKepemilikan)
        ->addIndexColumn() // Add index column (DT_RowIndex)
        ->addColumn('aksi', function ($kepemilikan) { // Add action column
            $btn = '<a href="' . url('rw/kepemilikan/' . $kepemilikan->kepemilikan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('rw/kepemilikan/' . $kepemilikan->kepemilikan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            return $btn;
        })
        ->rawColumns(['aksi']) // Render HTML in the 'aksi' column
        ->make(true);
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

    $activeMenu = 'warga'; // Set menu yang aktif
    $activeSubMenu = 'kepemilikan_list';

    return view('rw.kepemilikan.show', [
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

   $activeMenu = 'warga'; // Set menu yang aktif
   $activeSubMenu = 'kepemilikan_list';

   return view('rw.kepemilikan.edit', [
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
        'penghasilan' => 'required|numeric|min:0',
        'keluarga_ditanggung' => 'required|integer|min:1',
        'pajak_motor' => 'required|numeric|min:0',
        'pajak_mobil' => 'required|numeric|min:0',
        'pajak_bumi_bangunan' => 'required|numeric|min:0',
        'tagihan_air' => 'required|numeric|min:0',
        'tagihan_listrik' => 'required|numeric|min:0',
        'hutang' => 'required|numeric|min:0',
    ], [
        'penghasilan.required' => 'Penghasilan wajib diisi.',
        'penghasilan.numeric' => 'Penghasilan harus berupa angka.',
        'penghasilan.min' => 'Penghasilan tidak boleh kurang dari 0.',
        
        'keluarga_ditanggung.required' => 'Keluarga yang ditanggung wajib diisi.',
        'keluarga_ditanggung.integer' => 'Keluarga yang ditanggung harus berupa angka bulat.',
        'keluarga_ditanggung.min' => 'Keluarga yang ditanggung tidak boleh kurang dari 1.',
        
        'pajak_motor.required' => 'Pajak motor wajib diisi.',
        'pajak_motor.numeric' => 'Pajak motor harus berupa angka.',
        'pajak_motor.min' => 'Pajak motor tidak boleh kurang dari 0.',
        
        'pajak_mobil.required' => 'Pajak mobil wajib diisi.',
        'pajak_mobil.numeric' => 'Pajak mobil harus berupa angka.',
        'pajak_mobil.min' => 'Pajak mobil tidak boleh kurang dari 0.',
        
        'pajak_bumi_bangunan.required' => 'Pajak bumi dan bangunan wajib diisi.',
        'pajak_bumi_bangunan.numeric' => 'Pajak bumi dan bangunan harus berupa angka.',
        'pajak_bumi_bangunan.min' => 'Pajak bumi dan bangunan tidak boleh kurang dari 0.',
        
        'tagihan_air.required' => 'Tagihan air wajib diisi.',
        'tagihan_air.numeric' => 'Tagihan air harus berupa angka.',
        'tagihan_air.min' => 'Tagihan air tidak boleh kurang dari 0.',
        
        'tagihan_listrik.required' => 'Tagihan listrik wajib diisi.',
        'tagihan_listrik.numeric' => 'Tagihan listrik harus berupa angka.',
        'tagihan_listrik.min' => 'Tagihan listrik tidak boleh kurang dari 0.',
        
        'hutang.required' => 'Hutang wajib diisi.',
        'hutang.numeric' => 'Hutang harus berupa angka.',
        'hutang.min' => 'Hutang tidak boleh kurang dari 0.',
    ]);

    KepemilikanModel::find($id)->update([
        'penghasilan' => $request->penghasilan,
        'keluarga_ditanggung' => $request->keluarga_ditanggung,
        'pajak_motor' => $request->pajak_motor,
        'pajak_mobil' => $request->pajak_mobil,
        'pajak_bumi_bangunan' => $request->pajak_bumi_bangunan,
        'tagihan_air' => $request->tagihan_air,
        'tagihan_listrik' => $request->tagihan_listrik,
        'hutang' => $request->hutang,
    ]);
    $this->spkController->runSPK();
    return redirect('rw/kepemilikan')->with('success', 'Data kepemilikan berhasil diubah');
}


}
