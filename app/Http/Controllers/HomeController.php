<?php

namespace App\Http\Controllers;

use App\Services\Transaction_service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $transactionService;

    public function __construct(Transaction_service $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        session()->put('active_menu', 'home');

        $data['transactionSumaryByDate'] = $this->transactionService->getSumaryByDate();

        return view('Home/index', $data);
    }
}
