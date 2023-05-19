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

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // $user = $this->user_service->getUser('username', $request->username);
            // $request->session()->put('code', $user['code']);

            return redirect()->intended('/');
        }

        return back()->with('loginFailed', "Username atau password salah.");
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
