<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth_controller extends Controller
{
    public function login()
    {
        return view('Auth/login');
    }


    public function register()
    {
        return view('Auth/register');
    }
}
