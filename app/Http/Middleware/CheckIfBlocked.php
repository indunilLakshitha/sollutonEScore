<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and blocked
        if (Auth::check() && Auth::user()->active_status == User::BLOCKED) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account has been blocked. Contact support.');
        }
        return $next($request);
    }
}
