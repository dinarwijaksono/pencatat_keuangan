<?php

namespace App\Services;

use App\Domains\Transaction_domain;
use App\Models\Category;
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
    public function getById($id)
    {
        $item = DB::table('transactions')
            ->select('transactions.id', 'transactions.category_id', 'transactions.title as title', 'transactions.period', 'transactions.date', 'transactions.type', 'transactions.value')
            ->where('transactions.id', $id)
            ->first();

        $items = collect($item);
        if ($items->isEmpty()) {
            return [];
        }

        $result = [
            'id' => $item->id,
            'title' => $item->title,
            'period' => $item->period,
            'date' => $item->date,
            'type' => $item->type,
            'value' => $item->value,
        ];

        if (!is_null($item->category_id)) {
            $category = DB::table('categories')
                ->select('id', 'name')
                ->where('id', $item->category_id)
                ->first();

            $result['category_name'] = $category->name;
            $result['category_id'] = $category->id;
        } else {
            $result['category_name'] = null;
            $result['category_id'] = null;
        }



        return $result;
    }

    public function getByDateWithUserid(Transaction_domain $transaction_domain): array
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'category_id', 'transactions.title as title', 'transactions.period', 'transactions.date', 'transactions.type', 'transactions.value')
            ->where('transactions.user_id', $transaction_domain->user_id)
            ->where('transactions.date', $transaction_domain->date)
            ->get();

        $listCategory = DB::table('categories')
            ->select('id', 'name')
            ->where('user_id', $transaction_domain->user_id)
            ->get();


        $transactions = collect($transactions);
        if ($transactions->isEmpty()) {
            return [];
        }

        $listTransaction = [];
        foreach ($transactions as $key) {
            $array = [
                'id' => $key->id,
                'title' => $key->title,
                'period' => $key->period,
                'date' => $key->date,
                'type' => $key->type,
                'value' => $key->value,
            ];

            if (!is_null($key->category_id)) {
                $category = collect($listCategory);
                $filter = $category->where('id', $key->category_id)->first();
                $array['category_name'] = $filter->name;
                $array['category_id'] = $filter->id;
            } else {
                $array['category_name'] = null;
                $array['category_id'] = null;
            }

            $listTransaction[] = $array;
        }

        return $listTransaction;
    }


    public function getAllByUserid(Transaction_domain $transaction_domain)
    {
        $transactions = DB::table('transactions')
            ->select('category_id', 'transactions.title as title', 'transactions.period', 'transactions.date', 'transactions.type', 'transactions.value')
            ->where('transactions.user_id', $transaction_domain->user_id)
            ->orderBy('transactions.date', 'desc')
            ->get();

        $transactions = collect($transactions);
        if ($transactions->isEmpty()) {
            return [];
        }

        $listCategory = DB::table('categories')
            ->select('id', 'name')
            ->where('user_id', $transaction_domain->user_id)
            ->get();

        $listTransaction = [];
        foreach ($transactions as $key) {
            $listCategory = collect($listCategory);
            $transaction = [
                'category_id' => $key->category_id,
                'title' => $key->title,
                'period' => $key->period,
                'date' => $key->date,
                'type' => $key->type,
                'value' => $key->value,
            ];

            if (!is_null($key->category_id)) {
                $category = $listCategory->where('id', '=', $key->category_id)->first();
                $transaction['category_name'] = $category->name;
            } else {
                $transaction['category_name'] = null;
            }

            $listTransaction[] = $transaction;
        }

        return $listTransaction;
    }

    // update
    public function update(Transaction_domain $transaction_domain)
    {
        DB::table('transactions')
            ->where('id', $transaction_domain->id)
            ->update([
                'user_id' => $transaction_domain->user_id,
                'category_id' => $transaction_domain->category_id,
                'title' => $transaction_domain->title,
                'period' => $transaction_domain->period,
                'date' => $transaction_domain->date,
                'type' => $transaction_domain->type,
                'value' => $transaction_domain->value,
                'updated_at' => round(microtime(true) * 1000),
            ]);
    }

    // delete
    public function deleteById($id)
    {
        DB::table('transactions')
            ->where('id', $id)
            ->delete();
    }
}
