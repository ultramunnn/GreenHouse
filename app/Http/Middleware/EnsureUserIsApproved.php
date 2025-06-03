<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isApproved()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your account is pending approval.'], 403);
            }

            auth()->logout();
            return redirect()->route('login')
                ->with('status', 'Your account is pending approval. Please wait for an administrator to approve your account.');
        }

        return $next($request);
    }
} 