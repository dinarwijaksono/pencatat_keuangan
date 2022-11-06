<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Home_controller extends Controller
{
    public function index()
    {
        return view('Home/index');
    }

    public function addItem()
    {
        return view('Home/addItem');
    }
}
