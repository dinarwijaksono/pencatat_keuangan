<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home_controller extends Controller
{
    public function index()
    {
        return view('Home/index');
    }
}
