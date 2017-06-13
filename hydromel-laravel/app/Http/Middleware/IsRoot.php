<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsRoot
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
        if (Auth::user()->email != config('app.root')) {
            die('access denied');
        }
        return $next($request);
    }
}
