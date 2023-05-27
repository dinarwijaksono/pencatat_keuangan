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


    // read
    public function getByDate(int $date, string $username): array
    {
        $user = $this->userRepository->getByUsername($username);;

        $listTransaction = $this->transactionRepository->getByDate($date, $user->id);
        $spendingTotal = 0;
        $incomeTotal = 0;

        foreach ($listTransaction as $t) {
            if ($t->type == 'spending') {
                $spendingTotal += $t->value;
            } elseif ($t->type == 'income') {
                $incomeTotal += $t->value;
            }
        }

        $data['listTransaction'] = $listTransaction;
        $data['spendingTotal'] = $spendingTotal;
        $data['incomeTotal'] = $incomeTotal;

        return $data;
    }


    public function getTotalIncomeSpendingNotToday(string $username): array
    {
        $user = $this->userRepository->getByUsername($username);
        $dateTodayString = date('d-m-Y', time());
        $dateTodayInteger = strtotime($dateTodayString) * 1000;
        $transaction = $this->transactionRepository->getNotTodayByUserId($dateTodayInteger, $user->id);

        $listDate = [];
        foreach ($transaction as $t) {
            $listDate[] = $t->date;
        }

        $listDate = array_unique($listDate);

        $transactionTotal = [];
        foreach ($listDate as $date) {
            $incomeTotal = 0;
            $spendingTotal = 0;
            foreach ($transaction->where('date', $date) as $t) {
                if ($t->type == 'spending') {
                    $spendingTotal += $t->value;
                } elseif ($t->type == 'income') {
                    $incomeTotal += $t->value;
                }
            }

            $transactionTotal[] = [
                'date' => $date,
                'income_total' => $incomeTotal,
                'spending_total' => $spendingTotal
            ];
        }

        return $transactionTotal;
    }


    // delete
    public function deleteByCode(string $code): void
    {
        $this->transactionRepository->deleteByCode($code);
    }
}
