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

        print_r($response);
    }


    public function test_getTotalIncomeSpendingNotToday()
    {
        for ($i = 0; $i < 7; $i++) :
            $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));
            $date = $date * 1000;

            $listType = ['income', 'spending'];

            $request = new Request();
            $request['category_id'] = $this->category->id;
            $request['date'] = $date;
            $request['type'] = $listType[mt_rand(0, 1)];
            $request['item'] = 'contoh-' . mt_rand(1, 9);
            $request['value'] = mt_rand(1, 200) * 500;

            $this->transactionService->create($request, $this->user->username);
        endfor;

        $response = $this->transactionService->getTotalIncomeSpendingNotToday($this->user->username);
        $this->assertIsArray($response);
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

        // var_dump($response);
    }


    // update
    public function test_update()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));
        $date = $date * 1000;

        $request = new Request();
        $request['category_id'] = $this->category->id;
        $request['date'] = $date;
        $request['type'] = $this->type;
        $request['item'] = 'contoh-' . mt_rand(1, 9);
        $request['value'] = 10000;

        $this->transactionService->create($request, $this->user->username);

        $this->assertDatabaseHas('transactions', [
            'item' => $request->item,
            'value' => 10000,
            'date' => $request->date,
            'type' => $request->type,
            'category_id' => $this->category->id,
        ]);

        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));
        $date = $date * 1000;

        $transaction = DB::table('transactions')->select('code')->where('item', $request->item)->first();

        $request2 = new Request();
        $request2['code'] = $transaction->code;
        $request2['category_id'] = $this->category->id;
        $request2['date'] = $date;
        $request2['type'] = $this->type;
        $request2['item'] = 'dinarwijaksono11';
        $request2['value'] = 50000;

        $response = $this->transactionService->update($request2, $this->user->username);

        $this->assertTrue($response);
        $this->assertDatabaseHas('transactions', [
            'code' => $request2->code,
            'item' => 'dinarwijaksono11',
            'value' => 50000,
            'date' => $request2->date,
            'type' => $request2->type,
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
