<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessTentor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user) {
            return abort(401, 'Harap login terlebih dahulu');
        }
        if ($user->role->nama != 'Pengajar') {
            return abort(404, 'Anda tidak memiliki akses ke halaman pengajar');
        }
        if ($user->active == false) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Akun Anda telah dinonaktifkan oleh Admin.');
        }
        return $next($request);
    }
}
