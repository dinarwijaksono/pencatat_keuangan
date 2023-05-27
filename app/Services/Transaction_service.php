<?php

namespace App\Services;

use App\Domains\Transaction_domain;
use App\Repository\Transaction_repository;
use App\Repository\User_repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaction_service
{
    public $userRepository;
    public $transactionRepository;

    function __construct(User_repository $userRepository, Transaction_repository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }


    // create
    public function create(Request $request, string $username): bool
    {
        try {
            $user = $this->userRepository->getByUsername($username);

            $transaction = new Transaction_domain($user->id);
            $transaction->category_id = $request->category_id;
            $transaction->code = 'T' . mt_rand(1, 9999999);
            $transaction->period = date('M-Y', $request->date / 1000);
            $transaction->date = $request->date;
            $transaction->type = $request->type;
            $transaction->item = $request->item;
            $transaction->value = $request->value;

            $this->transactionRepository->create($transaction);

            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
