<?php

namespace App\Http\Controllers\rw;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WargaModel;

use Illuminate\Support\Facades\Auth;


class KeluargakuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $breadcrumb = (object) [
            'title' => 'Data Keluarga',
            'list'  => ['Home', 'Data Keluarga']
        ];

        $page = (object) [
            'title' => 'Daftar Keluarga yang terdaftar dalam sistem'
        ];

        $userNIK = auth()->user()->username;
        $userData = WargaModel::where('nik', $userNIK)->first();

if ($userData) {
    $keluargaku = WargaModel::where('nomor_kk', $userData->nomor_kk)->get();
    return view('rw.keluargaku.index', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'user' => $user,
        'activeMenu' => 'keluargaku',
        'activeSubMenu' => 'keluargaku_list',
        'keluargaku' => $keluargaku
    ]);
}
}
}