<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
            ];
        $activeMenu = 'dashboard';
        $activeSubMenu = '';
        return view('auth.ubah-password', ['breadcrumb' => $breadcrumb,'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        UserModel::find($user->user_id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        
        return redirect('/logout');
    }
}

