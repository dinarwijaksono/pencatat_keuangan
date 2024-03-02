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

    // public function getTotalIncomeAndSpending(): object



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
