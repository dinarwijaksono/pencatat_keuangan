<?php

namespace App\Repository;

use App\Domains\Transaction_domain;
use Illuminate\Support\Facades\DB;

class Transaction_repository
{
    public function create(Transaction_domain $transactionDomain): void
    {
        DB::table('transactions')
            ->insert([
                'user_id' => $transactionDomain->userId,
                'category_id' => $transactionDomain->categoryId,
                'code' => $transactionDomain->code,
                'period' => $transactionDomain->period,
                'date' => $transactionDomain->date,
                'type' => $transactionDomain->type,
                'item' => $transactionDomain->item,
                'value' => $transactionDomain->value,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);
    }
}
