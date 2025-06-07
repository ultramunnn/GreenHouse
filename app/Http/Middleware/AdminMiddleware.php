<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('filament.user.auth.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (auth()->user()->role !== 'admin') {
            auth()->logout();
            return redirect()->route('filament.user.auth.login')
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
} 