<?php

namespace Tests\Feature\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Services\TransactionService;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionServiceTest extends TestCase
{
    public $user;
    public $transactionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->user = User::select('*')->where('email', env("USER_EMAIL_TEST"))->first();
        $this->actingAs($this->user);

        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);

        $this->transactionService = $this->app->make(TransactionService::class);
    }

    public function test_get_transaction_detail_by_period()
    {
        $this->seed(TransactionSeeder::class);

        $transaction = Transaction::select('*')
            ->where('user_id', auth()->user()->id)
            ->first();

        $result = $this->transactionService->getTransactionDetailByPeriod($this->user->id, $transaction->period);

        $this->assertIsObject($result);

        $tran = $result->first();
        $this->assertObjectHasProperty('category_name', $tran);
        $this->assertObjectHasProperty('date', $tran);
    }

    public function test_get_transaction_detail_all(): void
    {
        $this->seed(TransactionSeeder::class);

        $result = $this->transactionService->getTransactionDetailAll($this->user->id);

        $this->assertIsObject($result);

        $tran = $result->first();
        $this->assertObjectHasProperty('category_name', $tran);
        $this->assertObjectHasProperty('date', $tran);
    }
}
