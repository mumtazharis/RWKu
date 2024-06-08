<?php
namespace App\Http\Controllers\warga;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\WargaModel;
use Illuminate\Support\Facades\Auth;

class WargaProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $breadcrumb = (object) [
            'title' => 'Profil Pengguna', 
            'list'  => ['Home', 'Profil'] 
        ];

        $page = (object) [
            'title' => 'Selamat Datang' 
        ];

        $userNik = auth()->user()->username;
        $warga = WargaModel::where('nik', $userNik)->first();

        // If warga not found, redirect or handle the case
        if (!$warga) {
            return redirect()->route('error.page')->with('error', 'Data yang Anda cari tidak ditemukan.');
        }

        return view('warga.profile.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => 'profile',
            'activeSubMenu' => 'profile_list',
            'warga' => $warga
        ]);
    }
}
