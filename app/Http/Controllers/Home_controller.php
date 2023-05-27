<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use App\Services\Transaction_service;
use App\Services\User_service;

class Home_controller extends Controller
{
    protected $userService;
    protected $transactionService;

    public function __construct(User_service $userService, Transaction_service $transactionService)
    {
        $this->userService = $userService;
        $this->transactionService = $transactionService;
    }



    public function index()
    {
        $day = date('j', time());
        $month = date('m', time());
        $year = date('Y', time());
        $date = mktime(0, 0, 0, $month, $day, $year) * 1000;

        $data['transactionToday'] = $this->transactionService->getByDate($date, session()->get('username'));
        $data['list_transaction_not_today'] = $this->transactionService->getTotalIncomeSpendingNotToday(session()->get('username'));

        return view('Home/index', $data);
    }

    public function doDelete(string $code)
    {
        $this->transactionService->deleteByCode($code);

        return redirect('/')->with('deleteTransactionSuccess', 'Transaksi berhasil di hapus.');
    }
}
