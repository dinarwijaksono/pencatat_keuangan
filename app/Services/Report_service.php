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


    // public function getPeriodAll()

    // public function getTotalCategoryListByPeriod(string $period): ?object



    public function getTotalTransactionInDayByperiod(string $period, string $type, string $username)
    {
        $user = $this->userRepository->getByUsername($username);

        $transaction = collect($this->transactionRepository
            ->getTotalTransactionInDayByperiod($period, $type, $user->id));

        return $transaction;
    }
}
