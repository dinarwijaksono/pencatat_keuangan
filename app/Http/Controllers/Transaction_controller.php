<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use Illuminate\Http\Request;
use App\Services\Category_service;
use App\Services\Transaction_service;

class Transaction_controller extends Controller
{

    public function __construct()
    {
    }


    public function addItem($time = 0)
    {
        if ($time == 0) {
            $time = time();
        }

        $data['time'] = $time;

        return view('Transaction/addItem', $data);
    }




    public function transactionDetail($date)
    {
        $data['date'] = $date;

        return view('Transaction/transactionDetail', $data);
    }



    public function editTransaction($id)
    {
    }
}
