<?php

namespace App\Http\Controllers;
use Request;
use Auth;
use Session;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth/login');
    }

    public function check()
    {
        $email = Request::input('email', '');
        $password = Request::input('password', '');
        if (!Auth::attempt(['email' => $email, 'password' => $password], false)) {
            return redirect()->action('AuthController@login')->with('error', true);
        }
        return redirect(Session::get('oldUrl', '/'));

    }

    public function logout()
    {
        //Auth::logout();
        Session::flush();
        return redirect()->action('AuthController@login');
    }
}