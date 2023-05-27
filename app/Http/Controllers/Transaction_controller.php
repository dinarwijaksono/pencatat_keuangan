<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use Illuminate\Http\Request;
use App\Services\Category_service;
use App\Services\Transaction_service;

class Transaction_controller extends Controller
{
    public $transactionService;

    public function __construct(Transaction_service $transaction_service)
    {
        $this->transactionService = $transaction_service;
    }


    public function addItem($time = 0)
    {
        if ($time == 0) {
            $time = time();
        }

        $data['time'] = $time;

        return view('Transaction/addItem', $data);
    }




    public function transactionDetail(int $date)
    {
        $date *= 1000;

        $data['date'] = $date;

        $data['transactionInDate'] = $this->transactionService->getByDate($date, session()->get('username'));

        return view('Transaction/transactionDetail', $data);
    }



    public function editTransaction(int $id, int $date)
    {
    }

    public function doDelete(int $id, int $date)
    {
        $this->transactionService->deleteById($id);

        return redirect("/Transaction/transactionDetail/$date")->with('deleteTransactionSuccess', 'Transaksi berhasil di hapus.');
    }
}
