<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\User;
use Request;
use Auth;
use Session;

class AuthController extends Controller
{

    public function login() {
        return view('auth/login');
    }

    public function check() {
        $email = Request::input('email', '');
        $password = Request::input('password', '');
        if (!Auth::attempt(['email' => $email, 'password' => $password], false)) {
            return redirect()->action('AuthController@login')->with('error', true);
        }
        //si le middleware est passé il redirige vers le deuxième paramêtre
        return redirect(Session::get('oldUrl', '/'));
    }


    public function logout() {
        //Auth::logout();
        Session::flush();
        return redirect()->action('AuthController@login');
    }
}