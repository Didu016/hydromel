<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Illuminate\Support\Facades\Auth;


class Authenticate {

<<<<<<< HEAD:hydromel-laravel/app/Http/Middleware/MyAuth.php
class MyAuth
{
=======
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028:hydromel-laravel/app/Http/Middleware/Authenticate.php
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
<<<<<<< HEAD:hydromel-laravel/app/Http/Middleware/MyAuth.php
    public function handle($request, Closure $next)
    {        
=======
    public function handle($request, Closure $next) {
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028:hydromel-laravel/app/Http/Middleware/Authenticate.php
        if (!Auth::check()) {
            Session::put('oldUrl', $request->fullUrl());
            return redirect()->action('AuthController@login');
        }
        return $next($request);
    }
<<<<<<< HEAD:hydromel-laravel/app/Http/Middleware/MyAuth.php
=======

>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028:hydromel-laravel/app/Http/Middleware/Authenticate.php
}
