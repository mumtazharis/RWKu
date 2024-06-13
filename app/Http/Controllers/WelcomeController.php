<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WargaModel;
use App\Models\KegiatanModel; // Pastikan model KegiatanModel di-import
use App\Models\KeuanganModel;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Breadcrumb data
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        // Active menu dan submenu
        $activeMenu = 'dashboard';
        $activeSubMenu = '';

        // Mengambil data jumlah warga per RT
        $rtCounts = WargaModel::selectRaw('rt, count(*) as total')
            ->groupBy('rt')
            ->get();

        // Siapkan data labels (RT) dan data (jumlah warga)
        $labels = $rtCounts->pluck('rt')->toArray();
        $data = $rtCounts->pluck('total')->toArray();

        // Mengambil data jumlah kegiatan per bulan
        $kegiatanCounts = KegiatanModel::selectRaw('MONTH(kegiatan_tanggal) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Siapkan data labels (bulan) dan data (jumlah kegiatan)
        $bulanLabels = $kegiatanCounts->pluck('bulan')->toArray();
        $jumlahKegiatan = $kegiatanCounts->pluck('total')->toArray();

        // Hitung total warga
        $totalWarga = WargaModel::count();

        // Hitung total kegiatan
        $totalKegiatan = KegiatanModel::count();

        $saldo = KeuanganModel::query();
        $keuangan = $saldo->get();
        $kas = $keuangan->sum('pemasukan') - $keuangan->sum('pengeluaran');
        

        return view('welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu,
            'labels' => $labels,
            'data' => $data,
            'bulanLabels' => $bulanLabels,
            'jumlahKegiatan' => $jumlahKegiatan,
            'totalWarga' => $totalWarga,
            'totalKegiatan' => $totalKegiatan,
            'kas' => $kas
        ]);
    }
}

