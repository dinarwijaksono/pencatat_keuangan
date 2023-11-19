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


    public function addItem()
    {

        $data['time'] = time();

        return view('Transaction/addItem', $data);
    }


    public function transactionDetail(int $date)
    {
        $date *= 1000;

        $data['date'] = $date;

        $data['transactionInDate'] = $this->transactionService->getByDate($date, session()->get('username'));

        return view('Transaction/transactionDetail', $data);
    }



    public function editTransaction(string $code)
    {
        $data['code'] = $code;

        return view('/Transaction/editItem', $data);
    }




    public function doDelete(string $code, int $date)
    {
        $this->transactionService->deleteByCode($code);

        $dateLink = $date / 1000;

        return redirect("/Transaction/transactionDetail/$dateLink")->with('deleteTransactionSuccess', 'Transaksi berhasil di hapus.');
    }
}
