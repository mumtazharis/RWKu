<?php

namespace App\Http\Controllers\warga;
use App\Http\Controllers\Controller;

use App\Models\KeuanganModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WargaKeuanganController extends Controller
{
    public function index()
    {
        // Set the breadcrumb data
        $breadcrumb = (object) [
            'title' => 'Daftar Keuangan',
            'list' => ['Home', 'Keuangan']
        ];

        // Set the page data
        $page = (object) [
            'title' => 'Daftar keuangan RW yang terdaftar dalam sistem'
        ];

        // Set the active menu
        $activeMenu = 'keuangan';
        $activeSubMenu = 'keuangan_list';

        // Fetch keuangan data
        $keuangan = KeuanganModel::all();

        // Return the view with data
        return view('warga.keuangan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu,
            'keuangan' => $keuangan
        ]);
    }
    public function list(Request $request)
{
    if ($request->ajax()) {
        $query = KeuanganModel::query();

        if ($request->has('penginput') && $request->penginput != '') {
            $query->where('penginput', $request->penginput);
        }

        $keuangan = $query->get();
        $saldo = $keuangan->sum('pemasukan') - $keuangan->sum('pengeluaran');
        
        

        return datatables()->of($keuangan) // Pass $keuangan data instead of $query
            ->addIndexColumn()
            ->with('saldo', $saldo) // Include saldo in the response
            ->make(true);
    }

    return view('warga.keuangan.index');
}

}
