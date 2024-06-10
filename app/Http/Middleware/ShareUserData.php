<?php

namespace App\Http\Middleware;

use App\Models\WargaModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareUserData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Retrieve warga data based on user id
            $warga = WargaModel::find($user->username); // Assuming username is the key to find in WargaModel
            View::share('usernama', $warga);
        }
        return $next($request);
    }
}
