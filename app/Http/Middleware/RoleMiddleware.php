<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('login'); // Redirect ke halaman login jika belum login
        }

        $user = Auth::user();

        // 2. Cek apakah peran pengguna sesuai dengan peran yang diminta di route
        if ($user->role !== $role) {
            // Jika peran tidak sesuai, kembalikan ke home atau tampilkan 403 Forbidden
            return redirect('/')->with('error', 'Akses ditolak.'); 
        }

        return $next($request);
    }
}
