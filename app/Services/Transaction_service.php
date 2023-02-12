<?php

namespace App\Services;

use App\Domains\Transaction_domain;
use Illuminate\Support\Facades\DB;

class Transaction_service
{

    public function addTransaction(Transaction_domain $transaction_domain)
    {
        DB::table('transactions')->insert([
            'user_id' => $transaction_domain->user_id,
            'category_id' => $transaction_domain->category_id,
            'title' => $transaction_domain->title,
            'period' => $transaction_domain->period,
            'date' => $transaction_domain->date,
            'type' => $transaction_domain->type,
            'value' => $transaction_domain->value,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);
    }


    // read
    public function getByDateWithUserid(Transaction_domain $transaction_domain): array
    {
        $transactions = DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select('categories.name as category_name', 'transactions.title as title', 'transactions.period', 'transactions.date', 'transactions.type', 'transactions.value')
            ->where('transactions.user_id', $transaction_domain->user_id)
            ->where('transactions.date', $transaction_domain->date)
            ->get();


        $transactions = collect($transactions);
        if ($transactions->isEmpty()) {
            return [];
        }

        $listTransaction = [];
        foreach ($transactions as $key) {
            $listTransaction[] = [
                'category_id' => $key->category_name,
                'title' => $key->title,
                'period' => $key->period,
                'date' => $key->date,
                'type' => $key->type,
                'value' => $key->value,
            ];
        }

        return $listTransaction;
    }
}
