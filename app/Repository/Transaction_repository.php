<?php

namespace App\Repository;

use App\Domains\Transaction_domain;
use Illuminate\Support\Facades\DB;

class Transaction_repository
{
    public function create(Transaction_domain $transaction_domain): void
    {
        DB::table('transactions')
            ->insert([
                'user_id' => $transaction_domain->user_id,
                'category_id' => $transaction_domain->category_id,
                'code' => $transaction_domain->code,
                'period' => $transaction_domain->period,
                'date' => $transaction_domain->date,
                'type' => $transaction_domain->type,
                'item' => $transaction_domain->item,
                'value' => $transaction_domain->value,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);
    }
}
