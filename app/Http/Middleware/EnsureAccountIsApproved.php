<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->isApproved()) {
            // Jika dia bukan Admin dan belum di-approve, logout dan kembalikan ke login
            if (!Auth::user()->isAdmin()) {
                Auth::logout();
                return redirect()->route('login')->with('status', 'Akun Anda belum disetujui oleh Admin. Silakan hubungi admin atau tunggu proses verifikasi.');
            }
        }

        return $next($request);
    }
}