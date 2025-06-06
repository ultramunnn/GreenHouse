<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                
                if (!$user->isApproved()) {
                    Auth::logout();
                    return redirect()->route('filament.user.auth.login')
                        ->with('error', 'Your account is pending approval.');
                }
                
                if ($user->isAdmin()) {
                    return redirect()->route('filament.admin.pages.dashboard');
                }
                
                return redirect()->route('filament.user.pages.dashboard');
            }
        }

        return $next($request);
    }
} 