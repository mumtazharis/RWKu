<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(){
        $user = Auth::user();

        if($user){
            return $this->redirectBasedOnRole($user->level_id);
        }
        return view('login');
    }

    public function proses_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            return $this->redirectBasedOnRole($user->level_id);
        }

        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukkan sudah benar']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return Redirect('login');
    }

    private function redirectBasedOnRole($level_id)
    {
        switch ($level_id) {
            case '1':
                return redirect()->route('home'); // Redirect ke rute home untuk level 1
            case '2':
                return redirect()->route('home'); // Redirect ke rute home untuk level 2
            case '3':
                return redirect()->route('home'); // Redirect ke rute home untuk level 3
            default:
                return redirect('/'); // Redirect default jika level_id tidak diketahui
        }
    }
}
