<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        session()->forget('active_menu');

        return view('User.index');
    }
}
