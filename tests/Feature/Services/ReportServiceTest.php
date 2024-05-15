<?php

namespace Tests\Feature\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Services\ReportService;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportServiceTest extends TestCase
{
    public $reportService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::select('*')->where('email', env("USER_EMAIL_TEST"))->first();
        $this->actingAs($user);

        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);

        $this->reportService = $this->app->make(ReportService::class);
    }

    public function test_getTotalIncomeAndSpending_success()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->seed(TransactionSeeder::class);
        }

        $response = $this->reportService->getTotalIncomeAndSpending();

        $this->assertIsObject($response);
        $this->assertIsNumeric($response->total_income);
        $this->assertIsNumeric($response->total_spending);
        $this->assertObjectHasProperty('total_income', $response);
        $this->assertObjectHasProperty('total_spending', $response);
    }

    public function test_getTotalIncomeAndSpending_success_transactionIsEmpty()
    {
        $response = $this->reportService->getTotalIncomeAndSpending();

        $this->assertIsObject($response);
        $this->assertIsNumeric($response->total_income);
        $this->assertIsNumeric($response->total_spending);
        $this->assertObjectHasProperty('total_income', $response);
        $this->assertObjectHasProperty('total_spending', $response);
    }


    public function test_getListPeriod_success()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->seed(TransactionSeeder::class);
        }

        $response = $this->reportService->getListPeriod();

        $getTransactionNotUnique = Transaction::select('period')->where('user_id', auth()->user()->id)
            ->orderBy('date')
            ->get();
        $getTransactionUnique = collect($getTransactionNotUnique)->unique();
        $getTransactionUniqueNew = [];

        foreach ($getTransactionUnique as $key) {
            $getTransactionUniqueNew[] = $key->period;
        }

        $this->assertIsArray($response);
        $this->assertNotEquals($response, $getTransactionNotUnique);
        $this->assertTrue(count($response) > 1);
        $this->assertEquals($response, $getTransactionUniqueNew);
    }



    public function test_getTotalCategoryListByPeriod_failed_transactionIsEmpty(): void
    {
        $response = $this->reportService->getTotalCategoryListByPeriod('Feb-2024');

        $this->assertIsObject($response);
        $this->assertTrue($response->isEmpty());
    }

    public function test_getTotalCategoryListByPeriod_success(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->seed(TransactionSeeder::class);
        }

        $getTransaction = Transaction::select('*')->where('user_id', auth()->user()->id)->first();

        $response = $this->reportService->getTotalCategoryListByPeriod($getTransaction->period);

        $this->assertIsObject($response);

        $response = collect($response->first())->toArray();

        $this->assertArrayHasKey('total_spending', $response);
        $this->assertArrayHasKey('total_income', $response);
        $this->assertArrayHasKey('category_id', $response);
        $this->assertArrayHasKey('category_name', $response);
    }
}
