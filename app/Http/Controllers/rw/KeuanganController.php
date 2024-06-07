<?php

namespace App\Http\Controllers\rw;
use App\Http\Controllers\Controller;

use App\Models\KeuanganModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KeuanganController extends Controller
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
        return view('rw.keuangan.index', [
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

    return view('rw.keuangan.index');
}

public function create()
{
    $breadcrumb = (object) [
        'title' => 'Tambah Keuangan',
        'list' => ['Home', 'Keuangan', 'Tambah']
    ];

    $page = (object) [
        'title' => 'Tambah Keuangan Baru'
    ];

    $userNik = auth()->user()->username;

    $warga = WargaModel::where('nik', $userNik)->first();

    $activeMenu = 'keuangan'; // Set menu yang aktif
    $activeSubMenu = 'keuangan_list';

    return view('rw.keuangan.create', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'activeMenu' => $activeMenu,
        'activeSubMenu' => $activeSubMenu,
        'warga' => $warga // Pass $userNik individually
    ]);
    }

    // Menyimpan data keuangan baru
    public function store(Request $request)
    {
        
        $request->validate([
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'pengeluaran_untuk' => 'nullable|string|max:255',
            'pemasukan_dari' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
        ]);

            // Get the nik of the authenticated user
        $penginput = Auth::user()->username;
            KeuanganModel::create([
                'penginput' => $penginput,
                'pemasukan' => $request->pemasukan,
                'pengeluaran' => $request->pengeluaran,
                'pengeluaran_untuk' => $request->pengeluaran_untuk,
                'pemasukan_dari' => $request->pemasukan_dari,
                'tanggal' => $request->tanggal,
            ]);
        return redirect('/keuangan')->with('success', 'Data keuangan berhasil ditambahkan');
    }
}
