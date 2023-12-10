<?php

namespace Tests\Feature\Services;

use App\Models\User;
use App\Services\Report_service;
use Database\Seeders\Category_seeder;
use Database\Seeders\Transaction_seeder;
use Database\Seeders\User_seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportService_Test extends TestCase
{
    protected $reportService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(User_seeder::class);

        $user = User::select('*')->first();
        $this->actingAs($user);

        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);

        $this->reportService = $this->app->make(Report_service::class);
    }

    public function test_getTotalIncomeAndSpending_success()
    {
        for ($i = 0; $i < 100; $i++) {
            $this->seed(Transaction_seeder::class);
        }

        $response = $this->reportService->getTotalIncomeAndSpending();

        $this->assertIsObject($response);
        $this->assertIsNumeric($response->total_income);
        $this->assertIsNumeric($response->total_spending);
    }


    public function test_getTotalIncomeAndSpending_empty()
    {
        $response = $this->reportService->getTotalIncomeAndSpending();

        $this->assertIsObject($response);
        $this->assertIsNumeric($response->total_income);
        $this->assertIsNumeric($response->total_spending);

        $this->assertEquals($response->total_income, 0);
        $this->assertEquals($response->total_spending, 0);
    }
}
