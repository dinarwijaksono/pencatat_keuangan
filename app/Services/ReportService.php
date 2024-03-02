<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class ReportService
{
    public string $class = 'App\Services\ReportService';

    // read
    public function getTotalIncomeAndSpending(): stdClass
    {
        try {
            $data = new stdClass();
            $data->total_income = 0;
            $data->total_spending = 0;
            $data->user_id = auth()->user()->id;

            $getTransaction = DB::table('transactions')
                ->select(
                    'user_id',
                    DB::raw('SUM(spending) as total_spending'),
                    DB::raw('SUM(income) as total_income')
                )
                ->groupBy('user_id')
                ->where('user_id', auth()->user()->id)
                ->first();

            Log::info('get total income and spending success', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->email
            ]);

            return $getTransaction ? $getTransaction : $data;
        } catch (\Throwable $th) {
            Log::error('get total income and spending failed', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->email,
                'exception' => $th->getMessage(),
            ]);

            return new stdClass();
        }
    }

    public function getListPeriod(): array
    {
        try {
            $listPeriod = Transaction::select('period')
                ->where('user_id', auth()->user()->id)
                ->orderBy('date')
                ->get();

            $listPeriod = collect($listPeriod)->unique();

            $listPeriodNew = [];

            foreach ($listPeriod as $key) {
                $listPeriodNew[] = $key->period;
            }

            Log::info('get list periode success', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->username,
                'class' => $this->class
            ]);

            return $listPeriodNew;
        } catch (\Throwable $th) {

            Log::error('get list periode failed', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->username,
                'class' => $this->class,
                'message' => $th->getMessage()
            ]);

            return [];
        }
    }


    public function getTotalCategoryListByPeriod(string $period): object
    {
        try {
            $transaction = DB::table('transactions')
                ->join('categories', 'transactions.category_id', '=', 'categories.id')
                ->select(
                    DB::raw('SUM(transactions.spending) as total_spending'),
                    DB::raw('SUM(transactions.income) as total_income'),
                    'transactions.category_id',
                    'categories.name as category_name'
                )
                ->where('transactions.user_id', auth()->user()->id)
                ->where('transactions.period', $period)
                ->orderBy('total_income')
                ->orderBy('total_spending')
                ->groupBy('transactions.category_id', 'categories.name')
                ->get();

            Log::info('get total category list by periode success', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->username,
                'class' => $this->class,
            ]);

            return $transaction;
        } catch (\Throwable $th) {
            Log::error('get total category list by periode failed', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->username,
                'class' => $this->class,
                'message' => $th->getMessage()
            ]);

            return collect([]);
        }
    }
}
