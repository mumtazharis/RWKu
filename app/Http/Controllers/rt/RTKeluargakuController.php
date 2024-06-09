<?php

namespace App\Http\Controllers\rt;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WargaModel;
use Yajra\DataTables\Facades\DataTables;

class RTKeluargakuController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'list' => ['Home', 'Keluargaku']
        ];

        // Set the page data
        $page = (object) [
            'title' => 'Daftar Anggota Keluarga yang terdaftar dalam sistem'
        ];

        // Set the active menu
        $activeMenu = 'warga';
        $activeSubMenu = 'warga_list';

        // Return the view with data
        return view('rt.keluargaku.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu
        ]);
    }

    public function list(Request $request)
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Mendapatkan nomor_kk pengguna yang sedang login
        $nomorKk = $user->nomor_kk;

        // Query untuk mendapatkan anggota keluarga berdasarkan nomor_kk
        $query = WargaModel::where('nomor_kk', $nomorKk);

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }
}
