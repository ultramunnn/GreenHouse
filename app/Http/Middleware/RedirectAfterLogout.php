<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectAfterLogout
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!Auth::check() && !$request->is('user/login*')) {
            return redirect()->to('/user/login');
        }

        return $response;
    }
} 