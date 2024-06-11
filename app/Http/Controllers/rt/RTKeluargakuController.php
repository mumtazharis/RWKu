<?php

namespace App\Http\Controllers\rt;
use App\Http\Controllers\Controller;
use App\Models\KeluargaModel;
use App\Models\KepemilikanModel;
use App\Models\RTModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WargaModel;
use Yajra\DataTables\Facades\DataTables;

class RTKeluargakuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $breadcrumb = (object) [
            'title' => 'Data Keluarga',
            'list'  => ['Home', 'Data Keluarga']
        ];

        $page = (object) [
            'title' => 'Keluarga saya'
        ];

        $userNIK = auth()->user()->username;
        $userData = WargaModel::where('nik', $userNIK)->first();
        $keluarga  = KeluargaModel::find($userData->nomor_kk);
        $alamat  = RTModel::where('rt_id', $keluarga->alamat_kk)->first();
        $kepemilikan  = KepemilikanModel::where('nomor_kk', $userData->nomor_kk)->first();

        if ($userData) {
            $keluargaku = WargaModel::where('nomor_kk', $userData->nomor_kk)->get();
            return view('rt.keluargaku.index', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'user' => $user,
                'activeMenu' => 'keluargaku',
                'activeSubMenu' => 'keluargaku_list',
                'keluargaku' => $keluargaku,
                'keluarga' => $keluarga,
                'alamat' => $alamat,
                'kepemilikan' => $kepemilikan
            ]);
        }
    }
}
