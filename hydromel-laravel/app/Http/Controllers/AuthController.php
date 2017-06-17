<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
=======

>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
use Request;
use Auth;
use Session;

class AuthController extends Controller {

<<<<<<< HEAD
    public function login()
    {
        return view('auth/login');
    }

    public function check()
    {
        $email = Request::input('email', '');
=======
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
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
        $password = Request::input('password', '');
        if (!Auth::attempt(['username' => $username, 'password' => $password], false)) {
            return redirect()->action('AuthController@login')->with('error', true);
        }
<<<<<<< HEAD
        return redirect(Session::get('oldUrl', '/'));

    }

    public function logout()
    {
=======
        return redirect(Session::get('oldUrl', '/auth/home'));
    }

    public function changePassword() {
        
    }

    /**
     * Logout the user
     * @return login view
     */
    public function logout() {
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
        //Auth::logout();
        Session::flush();
        return redirect()->action('AuthController@login');
    }

}
