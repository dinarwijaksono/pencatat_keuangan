<?php

namespace App\Http\Controllers;

use App\Services\Transaction_service;
use Illuminate\Http\Request;

class TransactionHistory_controller extends Controller
{
    public $transactionService;

    public function __construct(Transaction_service $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $data['transactionHistory'] = $this->transactionService->getHistory();

        return view('TransactionHistory/index', $data);
    }
}
