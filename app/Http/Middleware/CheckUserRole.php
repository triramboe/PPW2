<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user is an admin
            if (Auth::user()->level === 'admin') {
                // User is an admin, handle the access restriction (e.g., redirect)
                return redirect('/buku')->with('error', 'Admins are not allowed to access this feature.');
            }
        }

        return $next($request);
    }
}