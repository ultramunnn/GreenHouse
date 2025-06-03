<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('filament.user.auth.login');
        }

        if (auth()->user()->role !== $role) {
            if ($role === 'admin') {
                return redirect()->route('filament.user.pages.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
            }

            return redirect()->route('filament.admin.pages.dashboard')
                ->with('error', 'Halaman ini hanya untuk user.');
        }

        return $next($request);
    }
} 