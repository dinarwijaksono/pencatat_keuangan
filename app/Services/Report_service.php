<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repository\Category_repository;
use App\Repository\Transaction_repository;
use App\Repository\User_repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class Report_service
{
    protected $userRepository;
    protected $categoryRepository;
    protected $transactionRepository;

    public function __construct(
        User_repository $userRepository,
        Category_repository $categoryRepository,
        Transaction_repository $transactionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function getTotalIncomeAndSpending(): object
    {
        $user = auth()->user();

        $data = DB::table('transactions')
            ->select('user_id', DB::raw('SUM(spending) as total_spending'), DB::raw('SUM(income) as total_income'))
            ->groupBy('user_id')
            ->where('user_id', $user->id)
            ->first();

        if (is_null($data)) {
            $data = new stdClass();
            $data->user_id = auth()->user()->id;
            $data->total_spending = 0;
            $data->total_income = 0;
        }

        Log::info('get total income and spending', [
            'user_id' => $user->id,
            'username' => $user->username
        ]);

        return $data;
    }


    public function getPeriodAll()
    {
        $userId = auth()->user()->id;

        $listPeriod = Transaction::select('period')
            ->where('user_id', $userId)
            ->orderBy('date')
            ->get();

        $listPeriod = collect($listPeriod);
        $listPeriod = $listPeriod->unique();

        $listPeriodNew = collect([]);

        foreach ($listPeriod as $period) {
            $listPeriodNew->push($period->period);
        }

        return $listPeriodNew;
    }


    public function getTotalCategoryListByPeriod(string $period): ?object
    {
        $transaction = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select(DB::raw('SUM(transactions.spending) as total_spending'), DB::raw('SUM(transactions.income) as total_income'), 'transactions.category_id', 'categories.name as category_name')
            ->where('transactions.user_id', auth()->user()->id)
            ->where('transactions.period', $period)
            ->orderBy('total_income')
            ->orderBy('total_spending')
            ->groupBy('transactions.category_id', 'categories.name')
            ->get();

        if (is_null($transaction)) {
            $transaciton = new stdClass();
        }

        Log::info('getTotalCategoryListByPeriod success', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
        ]);

        return $transaction;
    }


    public function getTotalTransactionInDayByperiod(string $period, string $type, string $username)
    {
        $user = $this->userRepository->getByUsername($username);

        $transaction = collect($this->transactionRepository->getTotalTransactionInDayByperiod($period, $type, $user->id));

        return $transaction;
    }
}
