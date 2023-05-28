<?php

namespace Tests\Feature\Services;

use App\Services\Category_service;
use App\Services\Transaction_service;
use App\Services\User_service;
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
    public $type;

    public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'mysql-test']);

        $this->transactionService = $this->app->make(Transaction_service::class);

        $listType = ['spending', 'income'];
        $this->type = $listType[mt_rand(0, 1)];

        // create and get user
        $userService = $this->app->make(User_service::class);
        $requsetUser = new Request();
        $requsetUser['username'] = 'contoh' . mt_rand(1, 99999);
        $requsetUser['password'] = 'rahasia';
        $userService->register($requsetUser);
        $this->user = $userService->getByUsername($requsetUser->username);

        // create and get category
        $categoryService = $this->app->make(Category_service::class);
        $requsetCategory = new Request();
        $requsetCategory['name'] = 'contoh-' . mt_rand(1, 999999);
        $requsetCategory['type'] = $this->type;
        $categoryService->addCategory($requsetCategory, $this->user->username);
        $category = collect($categoryService->getByUsername($this->user->username));
        $this->category = $category->first();
    }


    public function test_create_success()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));
        $date = $date * 1000;

        $request = new Request();
        $request['category_id'] = $this->category->id;
        $request['date'] = $date;
        $request['type'] = $this->type;
        $request['item'] = 'contoh-' . mt_rand(1, 9);
        $request['value'] = mt_rand(1, 200) * 500;

        $response = $this->transactionService->create($request, $this->user->username);

        $this->assertTrue($response);
        $this->assertDatabaseHas('transactions', [
            'category_id' => $request->category_id,
            'item' => $request->item,
            'value' => $request->value,
            'type' => $request->type
        ]);
    }


    public function test_getByDate()
    {
        $date = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(2000, 2023));
        $date = $date * 1000;

        $request = new Request();
        $request['category_id'] = $this->category->id;
        $request['date'] = $date;
        $request['type'] = $this->type;
        $request['item'] = 'contoh-' . mt_rand(1, 9);
        $request['value'] = mt_rand(1, 200) * 500;

        $this->transactionService->create($request, $this->user->username);

        $response = $this->transactionService->getByDate($date, $this->user->username);

        $this->assertIsArray($response);

        $response = collect($response['listTransaction']);
        $this->assertTrue(!is_null($response->where($request->item)));
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
}
