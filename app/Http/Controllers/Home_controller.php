<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use App\Services\Transaction_service;

class Home_controller extends Controller
{
    private $transaction_service;
    private $transaction_domain;

    public function __construct(Transaction_service $transaction_service, Transaction_domain $transaction_domain)
    {
        $this->transaction_service = $transaction_service;
        $this->transaction_domain = $transaction_domain;
    }



    public function index()
    {
        return "halaman home";


        // return view('Home/index', $data);
    }
}
