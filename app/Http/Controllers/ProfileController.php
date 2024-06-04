<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $activeMenu = 'profile'; // Definisikan variabel $activeMenu
        $activeSubMenu = 'profile_list';
        $user = Auth::user();
        
        return view('profile.show', compact('user', 'activeMenu')); // Kirim variabel $activeMenu ke tampilan
    }
}
