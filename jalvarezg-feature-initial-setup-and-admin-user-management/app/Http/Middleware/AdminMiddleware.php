<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // If not admin, redirect or abort
        // Redirecting to home might be a good default, or a specific access denied page
        return redirect('/home')->with('error', 'You do not have admin access.');
        // Alternatively, abort(403, 'Unauthorized action.');
    }
}
