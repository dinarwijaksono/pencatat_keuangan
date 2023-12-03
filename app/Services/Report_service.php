<?php

namespace App\Services;

use App\Repository\Category_repository;
use App\Repository\Transaction_repository;
use App\Repository\User_repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        Log::info('get total income and spending', [
            'user_id' => $user->id,
            'username' => $user->username
        ]);

        return $data;
    }


    public function getTotalCategoryListByPeriod(string $period, string $username)
    {
        $user = $this->userRepository->getByUsername($username);

        $listCategory = collect($this->categoryRepository->getByUserId($user->id));

        $categorySum = collect($this->transactionRepository->getTotalCategoryListByPeriod($period, $user->id));

        $categorySumWithName = collect([]);

        foreach ($categorySum as $category) {
            $c = $listCategory->where('id', $category->category_id)->first();

            $categorySumWithName->push([
                'category_name' => $c->name,
                'category_id' => $category->category_id,
                'type' => $c->type,
                'total' => $category->total,
            ]);
        }

        return $categorySumWithName;
    }


    public function getTotalTransactionInDayByperiod(string $period, string $type, string $username)
    {
        $user = $this->userRepository->getByUsername($username);

        $transaction = collect($this->transactionRepository->getTotalTransactionInDayByperiod($period, $type, $user->id));

        return $transaction;
    }
}
