<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User_service;

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

    public function doRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|max:40|min:4',
            'email' => 'required|unique:users',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ]);

        $this->user_service->createUser($request->username, $request->email, $request->password);

        return back()->with('registerSuccess', "Username berhasil di daftarkan.");
    }
}
