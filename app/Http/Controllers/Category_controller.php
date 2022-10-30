<?php

namespace App\Http\Controllers;

use App\Services\Category_service;
use Illuminate\Http\Request;

class Category_controller extends Controller
{
    public function index()
    {
        return view('Category/index');
    }
}
