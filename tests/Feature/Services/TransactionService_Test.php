<?php

namespace Tests\Feature\Services;

use App\Domains\Transaction_domain;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Category_service;
use App\Services\Transaction_service;
use App\Services\User_service;
use Database\Seeders\Category_seeder;
use Database\Seeders\Transaction_seeder;
use Database\Seeders\User_seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TransactionService_Test extends TestCase
{
    public $transactionService;
    public $user;
    public $category;

    public function setUp(): void
    {
        parent::setUp();

        $this->transactionService = $this->app->make(Transaction_service::class);

        // create and get user
        $this->seed(User_seeder::class);
        $this->user = User::select('*')->where('username', 'test')->first();

        $this->actingAs($this->user, 'web');

        // create and get category
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->category = Category::select('*')->where('user_id', $this->user->id)->first();
    }


    public function test_create_success()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));
        $date = $date * 1000;

        $transactionDomain = new Transaction_domain();
        $transactionDomain->categoryId = $this->category->id;
        $transactionDomain->date = $date;
        $transactionDomain->description = 'example-' . mt_rand(1, 999);
        $transactionDomain->spending = $this->category->type == 'spending' ? mt_rand(1, 9999) * 1000 : 0;
        $transactionDomain->income = $this->category->type == 'income' ? mt_rand(1, 100) * 1000 : 0;

        $this->transactionService->create($transactionDomain);

        $this->assertDatabaseHas('transactions', [
            'user_id' => auth()->user()->id,
            'category_id' => $transactionDomain->categoryId,
            'description' => $transactionDomain->description,
            'spending' => $transactionDomain->spending,
            'income' => $transactionDomain->income,
        ]);

        $this->assertDatabaseHas('transaction_histories', [
            'user_id' => auth()->user()->id,
            'mode' => 'create'
        ]);
    }


    public function test_getByCode_success()
    {
        $this->seed(Transaction_seeder::class);

        $transaction = Transaction::select('*')->first();

        $response = $this->transactionService->getByCode($transaction->code);
        $this->assertIsObject($response);
        $this->assertEquals($transaction->date, $response->date);
        $this->assertEquals($transaction->income, $response->income);
        $this->assertEquals($transaction->created_at, $response->created_at);
    }


    public function test_getByDate_success()
    {
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);

        $date = strtotime(date('m/d/y', time())) * 1000;

        $response = $this->transactionService->getByDate($date);

        $this->assertIsObject($response);

        $transaction = $response->first();
        $this->assertObjectHasProperty('category_name', $transaction);
        $this->assertObjectHasProperty('code', $transaction);
        $this->assertObjectHasProperty('spending', $transaction);
        $this->assertObjectHasProperty('income', $transaction);

        /* print_r($response); */
    }

    public function test_getByCategoryId_success()
    {
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);

        $transaction = Transaction::select('category_id', 'description')->first();

        $response = $this->transactionService->getByCategoryId($transaction->category_id);

        $this->assertIsObject($response);

        // var_dump($response);
    }


    public function test_getHistory_success()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));
        $date = $date * 1000;

        $transactionDomain = new Transaction_domain();
        $transactionDomain->categoryId = $this->category->id;
        $transactionDomain->date = $date;
        $transactionDomain->description = 'example-' . mt_rand(1, 999);
        $transactionDomain->spending = $this->category->type == 'spending' ? mt_rand(1, 9999) * 1000 : 0;
        $transactionDomain->income = $this->category->type == 'income' ? mt_rand(1, 100) * 1000 : 0;

        $this->transactionService->create($transactionDomain);

        $response = $this->transactionService->getHistory();

        $this->assertIsObject($response);

        $data = $response[0];

        $this->assertEquals($data->mode, 'create');
    }


    public function test_getSumaryByDate_success()
    {
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);
        $this->seed(Transaction_seeder::class);

        $response = $this->transactionService->getSumaryByDate();

        $this->assertIsObject($response);

        $transaction = $response->first();

        $this->assertObjectHasProperty('total_income', $transaction);
        $this->assertObjectHasProperty('total_spending', $transaction);
        $this->assertObjectHasProperty('date', $transaction);

        /* var_dump($response); */
    }


    // update
    public function test_update_success()
    {
        $this->seed(Transaction_seeder::class);

        $transaction = Transaction::select('code')->where('user_id', $this->user->id)->first();

        $category = Category::select('id', 'name', 'type')->where('user_id', auth()->user()->id)->get();
        $category = $category[mt_rand(0, $category->count() - 1)];


        $transactionDomain = new Transaction_domain();
        $transactionDomain->categoryId = $category->id;
        $transactionDomain->date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), 2023) * 1000;
        $transactionDomain->description = 'example-' . mt_rand(1, 999);
        $transactionDomain->spending = $category->type == 'spending' ? mt_rand(1, 999) * 1000 : 0;
        $transactionDomain->income = $category->type == 'income' ? mt_rand(1, 999) * 1000 : 0;

        $response = $this->transactionService->update($transaction->code, $transactionDomain);

        $this->assertIsBool($response);
        $this->assertTrue($response);

        $this->assertDatabaseHas('transactions', [
            'code' => $transaction->code,
            'date' => $transactionDomain->date,
            'description' => $transactionDomain->description,
        ]);
    }


    // delete
    public function test_deleteByCode_success()
    {
        $this->seed(Transaction_seeder::class);

        $transaction = Transaction::select('code')->where('user_id', $this->user->id)->first();

        $this->transactionService->deleteByCode($transaction->code);

        $this->assertDatabaseMissing('transactions', ['code' => $transaction->code]);
    }
}
