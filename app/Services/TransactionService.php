<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    public function boot(): void
    {
        Log::withContext([
            'class' => TransactionService::class,
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
        ]);
    }

    // read
    public function getTransactionDetailByPeriod(int $userId, string $period): Collection
    {
        self::boot();

        try {
            $transactions = DB::table('transactions')
                ->join('categories', 'categories.id', '=', 'transactions.category_id')
                ->select(
                    'transactions.user_id',
                    'transactions.category_id',
                    'categories.name as category_name',
                    'transactions.code',
                    'transactions.period',
                    'transactions.date',
                    'transactions.description',
                    'transactions.income',
                    'transactions.spending',
                    'transactions.created_at',
                    'transactions.updated_at',
                )
                ->where('transactions.user_id', $userId)
                ->where('transactions.period', $period)
                ->orderBy('transactions.date')
                ->get();

            Log::info('get transaction detail by period succes');

            return $transactions;
        } catch (\Throwable $th) {
            Log::error('get transaction detail by period failed', [
                'message' => $th->getMessage()
            ]);
        }
    }

    public function getTransactionDetailAll(int $userId): Collection
    {
        self::boot();

        try {
            $transaction = DB::table('transactions')
                ->join('categories', 'categories.id', '=', 'transactions.category_id')
                ->select(
                    'transactions.user_id',
                    'transactions.category_id',
                    'categories.name as category_name',
                    'transactions.code',
                    'transactions.period',
                    'transactions.date',
                    'transactions.description',
                    'transactions.income',
                    'transactions.spending',
                    'transactions.created_at',
                    'transactions.updated_at',
                )
                ->where('transactions.user_id', $userId)
                ->orderBy('transactions.date')
                ->get();

            Log::info('get transaction detail all success');
            return $transaction;
        } catch (\Throwable $th) {
            Log::error('get transaction detail all failed', [
                'message' => $th->getMessage()
            ]);
        }
    }
}
