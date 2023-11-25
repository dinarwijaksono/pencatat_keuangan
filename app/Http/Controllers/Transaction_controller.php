<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use Illuminate\Http\Request;
use App\Services\Category_service;
use App\Services\Transaction_service;

use function PHPUnit\Framework\isNull;

class Transaction_controller extends Controller
{
    public $transactionService;

    public function __construct(Transaction_service $transaction_service)
    {
        $this->transactionService = $transaction_service;
    }


    public function addItem(int $time)
    {
        $data['time'] = $time;

        return view('Transaction/addItem', $data);
    }


    public function detail(int $time)
    {
        $data['time']  = $time;

        return view('Transaction/detail', $data);
    }



    public function editTransaction(string $code)
    {
        $data['code'] = $code;

        return view('/Transaction/editItem', $data);
    }
}
