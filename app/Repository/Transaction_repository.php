<?php

namespace App\Repository;

use App\Domains\Transaction_domain;
use Illuminate\Support\Facades\DB;

class Transaction_repository
{
    // create
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


    // read
    public function getByCode(string $code): object
    {
        return DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(
                'transactions.id',
                'transactions.user_id',
                'transactions.category_id',
                'categories.name as category_name',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.type',
                'transactions.item',
                'transactions.value',
                'transactions.created_at',
                'transactions.updated_at'
            )
            ->where('transactions.code', $code)
            ->first();
    }


    public function getByDate(int $date, int $user_id): object
    {
        return DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(
                'transactions.id',
                'transactions.user_id',
                'transactions.category_id',
                'categories.name as category_name',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.type',
                'transactions.item',
                'transactions.value',
                'transactions.created_at',
                'transactions.updated_at'
            )
            ->where('transactions.user_id', $user_id)
            ->where('date', $date)
            ->get();
    }


    public function getByPeriod(string $period, int $userId): object
    {
        return DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(
                'transactions.user_id',
                'transactions.category_id',
                'categories.name as category_name',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.type',
                'transactions.item',
                'transactions.value',
                'transactions.created_at',
                'transactions.updated_at'
            )
            ->where('transactions.user_id', $userId)
            ->where('transactions.period', $period)
            ->orderBy('transactions.date', 'desc')
            ->get();
    }


    public function getNotTodayByUserId(int $dateToday, int $user_id): object
    {
        return DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(
                'transactions.user_id',
                'transactions.category_id',
                'categories.name as category_name',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.type',
                'transactions.item',
                'transactions.value',
                'transactions.created_at',
                'transactions.updated_at'
            )
            ->where('transactions.user_id', $user_id)
            ->where('transactions.date', '!=', $dateToday)
            ->orderBy('transactions.date', 'desc')
            ->get();
    }


    public function getTotalCategoryListByPeriod(string $period, int $userId): object
    {
        $category = DB::table('transactions')
            ->select('category_id', DB::raw('sum(value) as total'))
            ->where('user_id', $userId)
            ->where('period', $period)
            ->groupBy('category_id')
            ->orderBy('total', 'desc')
            ->get();

        return $category;
    }

    public function getTotalTransactionInDayByperiod(string $period, string $type, int $userId): object
    {
        $transaction = DB::table('transactions')
            ->select('date', DB::raw('sum(value) as total'))
            ->where('user_id', $userId)
            ->where('period', $period)
            ->where('type', $type)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $transaction;
    }


    public function getAllByUserId(int $userId): object
    {
        return DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(
                'transactions.user_id',
                'transactions.category_id',
                'categories.name as category_name',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.type',
                'transactions.item',
                'transactions.value',
                'transactions.created_at',
                'transactions.updated_at'
            )
            ->where('transactions.user_id', $userId)
            ->orderBy('transactions.created_at', 'desc')
            ->get();
    }


    // update
    public function update(Transaction_domain $transaction_domain): void
    {
        DB::table('transactions')
            ->where('code', $transaction_domain->code)
            ->update([
                'category_id' => $transaction_domain->category_id,
                'period' => $transaction_domain->period,
                'date' => $transaction_domain->date,
                'type' => $transaction_domain->type,
                'item' => $transaction_domain->item,
                'value' => $transaction_domain->value,
                'updated_at' => round(microtime(true) * 1000),
            ]);
    }



    // delete   
    public function deleteByCode(string $code): void
    {
        DB::table('transactions')
            ->where('code', $code)
            ->delete();
    }
}
