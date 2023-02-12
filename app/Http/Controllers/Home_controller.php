<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $transaction = $this->transaction_domain;
        $transaction->date = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
        $transaction->user_id = auth()->user()->id;

        $todayTransaction = $this->transaction_service->getByDateWithUserid($transaction);
        $data['todayTransaction'] = $todayTransaction;

        $totalIncomeToday = 0;
        $totalSpendingToday = 0;
        foreach ($todayTransaction as $key) {
            if ($key['type'] == 'pemasukan') {
                $totalIncomeToday += $key['value'];
            } else {
                $totalSpendingToday += $key['value'];
            }
        }

        $data['total'] = [
            'income' => $totalIncomeToday,
            'spending' => $totalSpendingToday,
        ];

        // return $data['todayTransaction'];

        return view('Home/index', $data);
    }
}
