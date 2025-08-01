<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('filament.user.auth.login');
        }

        if ($role === 'admin' && auth()->user()->role !== 'admin') {
            return redirect()->route('filament.user.pages.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        if ($role === 'user' && auth()->user()->role !== 'user') {
            return redirect()->route('filament.admin.pages.dashboard')
                ->with('error', 'Halaman ini hanya untuk user.');
        }

        return $next($request);
    }
} 