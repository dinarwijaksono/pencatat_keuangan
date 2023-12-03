<?php

namespace App\Services;

use App\Domains\Transaction_domain;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Repository\Transaction_repository;
use App\Repository\User_repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Transaction_service
{
    public $userRepository;
    public $transactionRepository;

    function __construct(User_repository $userRepository, Transaction_repository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }


    // create
    public function create(Transaction_domain $transactionDomain): bool
    {
        try {
            DB::beginTransaction();

            $code = 'T' . mt_rand(1, 9999999);

            Transaction::create([
                'user_id' => auth()->user()->id,
                'category_id' => $transactionDomain->categoryId,
                'code' => $code,
                'period' => date('M-Y', $transactionDomain->date / 1000),
                'date' => $transactionDomain->date,
                'description' => $transactionDomain->description,
                'spending' => $transactionDomain->spending,
                'income' => $transactionDomain->income,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);

            $category = Category::select('name')->where('id', $transactionDomain->categoryId)->first();

            $data = [
                "before" => [],
                "after" => [
                    'category_id' => $transactionDomain->categoryId,
                    'category_name' => $category->name,
                    'code' => $code,
                    'period' => date('M-Y', $transactionDomain->date / 1000),
                    'date' => $transactionDomain->date,
                    'description' => $transactionDomain->description,
                    'spending' => $transactionDomain->spending,
                    'income' => $transactionDomain->income
                ]
            ];

            TransactionHistory::create([
                'user_id' => auth()->user()->id,
                'mode' => 'create',
                'data' => json_encode($data),
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);

            Log::info("transaciton create success.", [
                'id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'content' => $data
            ]);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            //throw $th;

            Log::info("transaciton create failed.", [
                'id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'request' => [
                    'category_id' => $transactionDomain->categoryId,
                    'date' => $transactionDomain->date,
                    'description' => $transactionDomain->description,
                    'spending' => $transactionDomain->spending,
                    'income' => $transactionDomain->income,
                ]
            ]);

            DB::rollBack();
            return false;
        }
    }


    // read
    public function getByCode(string $code): object
    {
        $data = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select(
                'categories.code as category_code',
                'categories.name as category_name',
                'categories.type as category_type',
                'transactions.category_id as category_id',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.description',
                'transactions.spending',
                'transactions.income',
                'transactions.created_at',
                'transactions.updated_at'
            )
            ->orderByDesc('transactions.date')
            ->where('transactions.user_id', auth()->user()->id)
            ->where('transactions.code', $code)
            ->first();

        Log::info('get transaction by code', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'data' => [
                'code' => $code,
                'content' => $data
            ]
        ]);

        return $data;
    }


    public function getByDate(int $date): object
    {
        $data = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select(
                'categories.code as category_code',
                'categories.name as category_name',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.description',
                'transactions.spending',
                'transactions.income',
                'transactions.created_at',
                'transactions.updated_at'
            )
            ->orderByDesc('transactions.date')
            ->where('transactions.user_id', auth()->user()->id)
            ->where('transactions.date', $date)
            ->get();

        Log::info('get transaction by date', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'data' => [
                'content' => $data->toArray()
            ]
        ]);

        return $data;
    }


    public function getHistory(): object
    {
        $user = auth()->user();

        $transaction = TransactionHistory::select('user_id', 'mode', 'data', 'created_at', 'updated_at')
            ->where('user_id', $user->id)
            ->OrderByDesc('created_at')
            ->skip(0)
            ->take(10)
            ->get();

        Log::info('get transaction histories', [
            'user_id' => $user->id,
            'username' => $user->username,
        ]);

        return $transaction;
    }


    public function getAllPeriodByUsername(string $username): object
    {
        $user = $this->userRepository->getByUsername($username);

        $transactionList = $this->transactionRepository->getAllByUserId($user->id);

        $listPeriod = [];
        foreach ($transactionList as $transaction) {
            $listPeriod[] = ['period' => $transaction->period];
        }

        $listPeriod = collect($listPeriod);
        $listPeriod = collect($listPeriod->unique('period'));

        return $listPeriod;
    }



    public function getSumaryByDate(): object
    {
        $data = DB::table('transactions')
            ->select(
                'date',
                DB::raw('sum(spending) as total_spending'),
                DB::raw('sum(income) as total_income')
            )->groupBy('date')
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('date')
            ->skip(0)
            ->take(30)
            ->get();

        Log::info('getSumaryByDate', [
            'id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'date' => $data->toArray()
        ]);

        return  $data;
    }


    // update
    public function update(string $code, Transaction_domain $transactionDomain): bool
    {
        try {
            DB::beginTransaction();

            $transaction = DB::table('transactions')
                ->join('categories', 'categories.id', '=', 'transactions.category_id')
                ->select(
                    'categories.name as category_name',
                    'categories.id as category_id',
                    'transactions.id',
                    'transactions.period',
                    'transactions.date',
                    'transactions.description',
                    'transactions.spending',
                    'transactions.income'
                )->where('transactions.code', $code)
                ->first();

            $category = Category::select('name')->where('id', $transactionDomain->categoryId)->first();

            Transaction::where('code', $code)
                ->update([
                    'category_id' => $transactionDomain->categoryId,
                    'code' => $code,
                    'period' => date('M-Y', $transactionDomain->date / 1000),
                    'date' => $transactionDomain->date,
                    'description' => $transactionDomain->description,
                    'spending' => $transactionDomain->spending,
                    'income' => $transactionDomain->income,
                    'updated_at' => round(microtime(true) * 1000)
                ]);

            $data = [
                "before" => [
                    'transaction_id' => $transaction->id,
                    'category_id' => $transaction->category_id,
                    'category_name' => $transaction->category_name,
                    'code' => $code,
                    'period' => date('M-Y', $transaction->date / 1000),
                    'date' => $transaction->date,
                    'description' => $transaction->description,
                    'spending' => $transaction->spending,
                    'income' => $transaction->income
                ],
                'after' => [
                    'transaction_id' => $transaction->id,
                    'category_id' => $transactionDomain->categoryId,
                    'category_name' => $category->name,
                    'code' => $code,
                    'period' => date('M-Y', $transactionDomain->date / 1000),
                    'date' => $transactionDomain->date,
                    'description' => $transactionDomain->description,
                    'spending' => $transactionDomain->spending,
                    'income' => $transactionDomain->income
                ]
            ];

            TransactionHistory::create([
                'user_id' => auth()->user()->id,
                'mode' => 'update',
                'data' => json_encode($data),
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);

            DB::commit();

            Log::info('Update transaction success.', [
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'content' => $data
            ]);

            return true;
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Update transaction failed.', [
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'content' => [
                    'code' => $code,
                    'category_id' => $transactionDomain->categoryId,
                    'date' => $transactionDomain->date,
                    'description' => $transactionDomain->description,
                    'spending' => $transactionDomain->spending,
                    'income' => $transactionDomain->income
                ],
                'exception' => $th
            ]);

            return false;
        }
    }


    // delete
    public function deleteByCode(string $code): void
    {
        $transaction = DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(
                'transactions.id',
                'categories.id as category_id',
                'categories.name as category_name',
                'transactions.code',
                'transactions.period',
                'transactions.date',
                'transactions.description',
                'transactions.income',
                'transactions.spending',
            )
            ->first();

        $data = [
            'category_id' => $transaction->category_id,
            'category_name' => $transaction->category_name,
            'code' => $transaction->code,
            'period' => $transaction->date,
            'date' => $transaction->date,
            'description' => $transaction->description,
            'spending' => $transaction->spending,
            'income' => $transaction->income
        ];

        TransactionHistory::create([
            'user_id' => auth()->user()->id,
            'mode' => 'delete',
            'data' => json_encode([
                'after' => [],
                'before' => $data
            ]),
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);

        Transaction::where('code', $code)->delete();

        Log::info('delete transaction success', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'content' => $data
        ]);
    }
}
