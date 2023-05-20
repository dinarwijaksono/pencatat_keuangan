<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User_service;
use Illuminate\Support\Facades\Auth;

class Auth_controller extends Controller
{
    private $user_service;

    public function __construct(User_service $user_service)
    {
        $this->user_service = $user_service;
    }


    public function login()
    {
        return view('Auth/login');
    }






    public function register()
    {
        return view('Auth/register');
    }


    public function doLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
