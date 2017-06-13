<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Session;

class AuthController extends Controller {

    /**
     * Display login view
     * @return login view
     */
    public function login() {
        return view('auth/login');
    }

    /**
     * Check username and password and log the user in Laravel.
     * @return login view if user could not be authenticated, home view else. 
     */
    public function check() {
        $username = Request::input('username', '');
        $password = Request::input('password', '');
        if (!Auth::attempt(['username' => $username, 'password' => $password], false)) {
            return redirect()->action('AuthController@login')->with('error', true);
        }
        return redirect(Session::get('oldUrl', '/auth/accueil'));
    }

    /**
     * Logout the user
     * @return login view
     */
    public function logout() {
        //Auth::logout();
        Session::flush();
        return redirect()->action('AuthController@login');
    }

}
