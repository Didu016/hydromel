<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            Session::put('oldUrl', $request->fullUrl());
            return redirect()->action('AuthController@login');
        }
        return $next($request);
    }
}