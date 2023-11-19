<?php

namespace App\Services;

use App\Domains\Transaction_domain;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Repository\Transaction_repository;
use App\Repository\User_repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function create(Transaction_domain $transactionDomain): bool
    {
        try {
            DB::beginTransaction();

            $code = 'T' . mt_rand(1, 9999999);

            Transaction::create([
                'user_id' => auth()->user()->id,
                'category_id' => $transactionDomain->categoryId,
                'code' => $code,
                'period' => date('M-Y', $transactionDomain->date / 1000),
                'date' => $transactionDomain->date,
                'description' => $transactionDomain->description,
                'spending' => $transactionDomain->spending,
                'income' => $transactionDomain->income,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);

            $transaction = Transaction::select('id')->where('code', $code)->first();

            $data = [
                'period' => date('M-Y', $transactionDomain->date / 1000),
                'date' => $transactionDomain->date,
                'description' => $transactionDomain->description,
                'spending' => $transactionDomain->spending,
                'income' => $transactionDomain->income
            ];

            $data = json_encode($data);

            TransactionHistory::create([
                'user_id' => auth()->user()->id,
                'transaction_id' => $transaction->id,
                'mode' => 'create',
                'data' => $data,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);

            Log::info("transaciton create failed.", ['id' => auth()->user()->id]);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            //throw $th;

            Log::info("transaciton create failed.", ['id' => auth()->user()->id]);

            DB::rollBack();
            return false;
        }
    }


    // read
    public function getByCode(string $code): object
    {
        return $this->transactionRepository->getByCode($code);
    }


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

    public function getAllPeriodByUsername(string $username): object
    {
        $user = $this->userRepository->getByUsername($username);

        $transactionList = $this->transactionRepository->getAllByUserId($user->id);

        $listPeriod = [];
        foreach ($transactionList as $transaction) {
            $listPeriod[] = ['period' => $transaction->period];
        }

        $listPeriod = collect($listPeriod);
        $listPeriod = collect($listPeriod->unique('period'));

        return $listPeriod;
    }


    // update
    public function update(Request $request, string $username): bool
    {
        try {
            DB::beginTransaction();

            $user = $this->userRepository->getByUsername($username);

            $transactionDomain = new Transaction_domain($user->id);
            $transactionDomain->code = $request->code;
            $transactionDomain->category_id = $request->category_id;
            $transactionDomain->period = date('M-Y', $request->date / 1000);
            $transactionDomain->date = $request->date;
            $transactionDomain->type = $request->type;
            $transactionDomain->item = $request->item;
            $transactionDomain->value = $request->value;

            $this->transactionRepository->update($transactionDomain);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }


    // delete
    public function deleteByCode(string $code): void
    {
        $this->transactionRepository->deleteByCode($code);
    }
}
