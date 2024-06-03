<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use App\Models\KepemilikanModel;
use App\Models\RTModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\CheckNomorKKNull;

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
        $alamat = RTModel::all();

        // Return the view with data
        return view('keluarga.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu,
            'alamat' => $alamat
        ]);
    }
    public function list(Request $request) {
        // Select specific columns from the KeluargaModel
        $dataKeluarga = KeluargaModel::select('nomor_kk','nik_kepala_keluarga', 'alamat_kk', 'kelas_ekonomi');

        if ($request->alamat_kk){
            $dataKeluarga->where('alamat_kk', $request->alamat_kk);
        }
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

        $activeMenu = 'warga'; //set menu yang aktif
        $activeSubMenu = 'keluarga_list';

        $wargas = WargaModel::all(); 
        $alamatKks = RTModel::all();

        return view('keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu,'warga' => $wargas, 'alamatkk' => $alamatKks, 'activeSubMenu' => $activeSubMenu,]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kk' => 'required|integer|unique:keluarga,nomor_kk',
            'nik_kepala_keluarga' => 'required|numeric|exists:warga,nik|unique:keluarga,nik_kepala_keluarga',
            'alamat_kk' => 'required|string',
            'anggota_keluarga' => 'array',
            'anggota_keluarga.*' => ['required', new CheckNomorKKNull],

            'penghasilan' => 'required|numeric|min:0',
            'keluarga_ditanggung' => 'required|integer|min:0',
            'pajak_motor' => 'required|numeric|min:0',
            'pajak_mobil' => 'required|numeric|min:0',
            'pajak_bumi_bangunan' => 'required|numeric|min:0',
            'tagihan_air' => 'required|numeric|min:0',
            'tagihan_listrik' => 'required|numeric|min:0',
            'hutang' => 'required|numeric|min:0',

        ],[
            'nomor_kk.required' => 'Nomor KK wajib diisi.',
            'nomor_kk.integer' => 'Nomor KK harus berupa angka.',
            'nomor_kk.unique' => 'Nomor KK sudah digunakan.',
            
            'nik_kepala_keluarga.required' => 'NIK Kepala Keluarga wajib diisi.',
            'nik_kepala_keluarga.numeric' => 'NIK Kepala Keluarga harus berupa angka.',
            'nik_kepala_keluarga.exists' => 'NIK Kepala Keluarga tidak ditemukan.',
            'nik_kepala_keluarga.unique' => 'NIK Sudah menajdi kepala keluarga di kk lain.',
        
            'alamat_kk.required' => 'Alamat KK wajib diisi.',
            'alamat_kk.string' => 'Alamat KK harus berupa teks.',

            'anggota_keluarga.required' => 'Anggota Keluarga wajib dipilih.',
            'anggota_keluarga.array' => 'Format Anggota Keluarga tidak valid.',
            'anggota_keluarga.*.required' => 'Setiap anggota keluarga harus valid.',

            'penghasilan.required' => 'Penghasilan wajib diisi.',
            'penghasilan.numeric' => 'Penghasilan harus berupa angka.',
            'penghasilan.min' => 'Penghasilan tidak boleh kurang dari 0.',
            
            'keluarga_ditanggung.required' => 'Keluarga yang ditanggung wajib diisi.',
            'keluarga_ditanggung.integer' => 'Keluarga yang ditanggung harus berupa angka bulat.',
            'keluarga_ditanggung.min' => 'Keluarga yang ditanggung tidak boleh kurang dari 0.',
            
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

        KeluargaModel::create([
            'nomor_kk' => $request->nomor_kk,
            'nik_kepala_keluarga' => $request->nik_kepala_keluarga,
            'alamat_kk' => $request->alamat_kk,
        
        ]);

        KepemilikanModel::create([
            'nomor_kk' => $request->nomor_kk,
            'penghasilan' => $request->penghasilan,
            'keluarga_ditanggung' => $request->keluarga_ditanggung,
            'pajak_motor' => $request->pajak_motor,
            'pajak_mobil' => $request->pajak_mobil,
            'pajak_bumi_bangunan' => $request->pajak_bumi_bangunan,
            'tagihan_air' => $request->tagihan_air,
            'tagihan_listrik' => $request->tagihan_listrik,
            'hutang' => $request->hutang,
        ]);

        WargaModel::where('nik', $request->nik_kepala_keluarga)->update([
            'nomor_kk' => $request->nomor_kk
        ]);

        if ($request->has('anggota_keluarga')) {
            foreach ($request->anggota_keluarga as $nik) {
                WargaModel::where('nik', $nik)->update([
                    'nomor_kk' => $request->nomor_kk
                ]);
            }
        }
        


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

   $activeMenu = 'warga'; // Set menu yang aktif
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
