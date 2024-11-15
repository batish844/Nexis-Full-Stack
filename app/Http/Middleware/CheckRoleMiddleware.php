<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            if ($role == "admin" && Auth::user()->isAdmin) {
                return $next($request);
            }
            if ($role == "user" && !Auth::user()->isAdmin) {
                return $next($request);
            }
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

        return redirect()->back()->with('error', 'You are not Logged In.');
    }
}
