<?php

namespace App\Services;

use App\Repository\Category_repository;
use App\Repository\Transaction_repository;
use App\Repository\User_repository;
use Illuminate\Support\Facades\DB;

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

    public function getTotalIncomeAndSpending(string $username): array
    {
        $user = $this->userRepository->getByUsername($username);

        $transaction = $this->transactionRepository->getAllByUserId($user->id);
        $spendingTotal = 0;
        $incomeTotal = 0;

        foreach ($transaction as $key) :
            if ($key->type == 'income') :
                $incomeTotal += $key->value;
            elseif ($key->type == 'spending') :
                $spendingTotal += $key->value;
            endif;
        endforeach;

        $data = [
            'incomeTotal' => $incomeTotal,
            'spendingTotal' => $spendingTotal,
        ];

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
}
