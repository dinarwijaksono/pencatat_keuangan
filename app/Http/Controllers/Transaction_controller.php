<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transaction_controller extends Controller
{
    public function addItem()
    {
        return view('Transaction/addItem');
    }


    public function transactionDetail()
    {
        return view('Transaction/transactionDetail');
    }
}
