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
        $user_id = auth()->user()->id;

        $transaction = $this->transaction_domain;
        $transaction->date = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
        $transaction->user_id = $user_id;

        $todayTransaction = $this->transaction_service->getByDateWithUserid($transaction);
        $data['todayTransaction'] = $todayTransaction;

        $totalIncomeToday = 0;
        $totalSpendingToday = 0;
        foreach ($todayTransaction as $key) {
            if ($key['type'] == 'income') {
                $totalIncomeToday += $key['value'];
            } else {
                $totalSpendingToday += $key['value'];
            }
        }

        $data['todayTotal'] = [
            'income' => $totalIncomeToday,
            'spending' => $totalSpendingToday,
        ];



        $t = $this->transaction_domain;
        $t->user_id = $user_id;
        $listTransaction = $this->transaction_service->getAllByUserid($t);
        $listTransactionDate = [];
        foreach ($listTransaction as $transaction) {
            if (!in_array($transaction['date'], $listTransactionDate)) {
                $listTransactionDate[] = $transaction['date'];
            }
        }
        $data['listTransaction'] = [];
        for ($i = 0; $i < count($listTransactionDate); $i++) :
            $income = 0;
            $spending = 0;
            foreach ($listTransaction as $key) :
                if ($key['date'] == $listTransactionDate[$i]) {
                    if ($key['type'] == 'income') {
                        $income += $key['value'];
                    } else {
                        $spending += $key['value'];
                    }
                }
            endforeach;
            $data['listTransaction'][] = [
                'date' => $listTransactionDate[$i],
                'income' => $income,
                'spending' => $spending
            ];
        endfor;

        return view('Home/index', $data);
    }
}
