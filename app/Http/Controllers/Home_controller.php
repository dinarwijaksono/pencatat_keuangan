<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use App\Services\Transaction_service;
use App\Services\User_service;

class Home_controller extends Controller
{
    protected $transactionService;

    public function __construct(Transaction_service $transactionService)
    {
        $this->transactionService = $transactionService;
    }



    public function index()
    {
        $data['transactionSumaryByDate'] = $this->transactionService->getSumaryByDate();

        return view('Home/index', $data);
    }
}
