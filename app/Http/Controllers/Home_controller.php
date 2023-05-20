<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use App\Services\Transaction_service;
use App\Services\User_service;

class Home_controller extends Controller
{
    protected $userService;

    public function __construct(User_service $userService)
    {
        $this->userService = $userService;
    }



    public function index()
    {
        return view('Home/index');
    }


    public function logout()
    {
        $this->userService->logout();

        return redirect('/Auth/login');
    }
}
