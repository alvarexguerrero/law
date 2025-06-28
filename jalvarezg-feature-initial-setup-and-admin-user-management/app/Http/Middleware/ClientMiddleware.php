<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
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
        if (Auth::check() && Auth::user()->isClient()) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have client access.');
        // Alternatively, abort(403, 'Unauthorized action.');
    }
}
