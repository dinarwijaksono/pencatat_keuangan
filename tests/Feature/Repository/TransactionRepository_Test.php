<?php

namespace Tests\Feature\Repository;

use App\Domains\Transaction_domain;
use App\Repository\Transaction_repository;
use App\Services\Category_service;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TransactionRepository_Test extends TestCase
{
    public $transactionRepository;
    public $user;
    public $category;
    public $type;

    public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'mysql-test']);

        $this->transactionRepository = $this->app->make(Transaction_repository::class);

        $listType = ['spending', 'income'];
        $this->type = $listType[mt_rand(0, 1)];

        $userService = $this->app->make(User_service::class);
        $requestUser = new Request();
        $requestUser['username'] = 'contoh-' . mt_rand(1, 99999);
        $requestUser['password'] = 'rahasia';
        $userService->register($requestUser);
        $this->user = $userService->getByUsername($requestUser->username);

        // create and get category
        $categoryService = $this->app->make(Category_service::class);
        $request = new Request();
        $request['name'] = 'contoh-' . mt_rand(1, 9999);
        $request['type'] = $this->type;
        $categoryService->addCategory($request, $this->user->username);

        $category = collect($categoryService->getByUsername($this->user->username));
        $this->category = $category->first();
    }

    public function test_create()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));

        $transactionDomain = new Transaction_domain($this->user->id);
        $transactionDomain->category_id = $this->category->id;
        $transactionDomain->code = 'T' . mt_rand(1, 9999999);
        $transactionDomain->period = date('M-Y', $date);
        $transactionDomain->date = $date * 1000;
        $transactionDomain->type = $this->type;
        $transactionDomain->item = 'contoh-' . mt_rand(1, 300);
        $transactionDomain->value = mt_rand(1, 100) * 500;

        $this->transactionRepository->create($transactionDomain);

        $this->assertDatabaseHas('transactions', [
            'category_id' => $transactionDomain->category_id,
            'date' => $transactionDomain->date,
            'item' => $transactionDomain->item,
        ]);
    }

    public function test_getByDate()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));

        $transactionDomain = new Transaction_domain($this->user->id);
        $transactionDomain->category_id = $this->category->id;
        $transactionDomain->code = 'T' . mt_rand(1, 9999999);
        $transactionDomain->period = date('M-Y', $date);
        $transactionDomain->date = $date * 1000;
        $transactionDomain->type = $this->type;
        $transactionDomain->item = 'contoh-' . mt_rand(1, 300);
        $transactionDomain->value = mt_rand(1, 100) * 500;

        $this->transactionRepository->create($transactionDomain);

        $response = $this->transactionRepository->getByDate($date, $this->user->id);
        $this->assertIsObject($response);
    }


    public function test_getNotTodayByUserId()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));

        $transactionDomain = new Transaction_domain($this->user->id);
        $transactionDomain->category_id = $this->category->id;
        $transactionDomain->code = 'T' . mt_rand(1, 9999999);
        $transactionDomain->period = date('M-Y', $date);
        $transactionDomain->date = $date * 1000;
        $transactionDomain->type = $this->type;
        $transactionDomain->item = 'contoh-' . mt_rand(1, 300);
        $transactionDomain->value = mt_rand(1, 100) * 500;

        $this->transactionRepository->create($transactionDomain);

        $response = $this->transactionRepository->getNotTodayByUserId($date, $this->user->id);
        $this->assertIsObject($response);
    }


    public function test_deleteById()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));

        $transactionDomain = new Transaction_domain($this->user->id);
        $transactionDomain->category_id = $this->category->id;
        $transactionDomain->code = 'T' . mt_rand(1, 9999999);
        $transactionDomain->period = date('M-Y', $date);
        $transactionDomain->date = $date * 1000;
        $transactionDomain->type = $this->type;
        $transactionDomain->item = 'contoh-' . mt_rand(1, 300);
        $transactionDomain->value = mt_rand(1, 100) * 500;

        $this->transactionRepository->create($transactionDomain);

        $transaction = DB::table('transactions')
            ->select('id')
            ->where('item', $transactionDomain->item)
            ->first();

        $this->assertDatabaseHas('transactions', ['item' => $transactionDomain->item]);

        $this->transactionRepository->deleteById($transaction->id);

        $this->assertTrue(true);

        $this->assertDatabaseMissing('transactions', ['item' => $transactionDomain->item]);
    }
}
