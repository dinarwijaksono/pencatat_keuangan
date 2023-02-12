<?php

namespace App\Services;

use App\Domains\Transaction_domain;
use Illuminate\Support\Facades\DB;

class Transaction_service
{

    public function addTransaction(Transaction_domain $item_domain)
    {
        DB::table('transactions')->insert([
            'user_id' => $item_domain->user_id,
            'category_id' => $item_domain->category_id,
            'title' => $item_domain->title,
            'period' => $item_domain->period,
            'date' => $item_domain->date,
            'type' => $item_domain->type,
            'value' => $item_domain->value,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);
    }
}
