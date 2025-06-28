<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LawyerMiddleware
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
        if (Auth::check() && Auth::user()->isLawyer()) {
            // Optionally, you might also check if the lawyer is verified
            // if (Auth::user()->verified) {
            //     return $next($request);
            // }
            // return redirect('/home')->with('error', 'Your lawyer account is pending verification.');
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have lawyer access.');
        // Alternatively, abort(403, 'Unauthorized action.');
    }
}
