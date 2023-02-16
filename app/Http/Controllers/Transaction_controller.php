<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use Illuminate\Http\Request;
use App\Services\Category_service;
use App\Services\Transaction_service;

class Transaction_controller extends Controller
{
    protected $transaction_domain;
    protected $transaction_service;
    protected $catetegory_service;

    public function __construct(Transaction_service $transaction_service, Transaction_domain $transaction_domain, Category_service $category_service)
    {
        $this->transaction_domain = $transaction_domain;
        $this->transaction_service = $transaction_service;
        $this->catetegory_service = $category_service;
    }


    public function addTransaction()
    {
        $user_id = auth()->user()->id;
        $data['listCategory'] = $this->catetegory_service->getListCategory($user_id);

        return view('Transaction/addItem', $data);
    }

    public function transactionDetail($date)
    {
        $data['date'] = $date;

        return view('Transaction/transactionDetail', $data);
    }
}
