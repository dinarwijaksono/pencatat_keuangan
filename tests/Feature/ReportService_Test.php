<?php

namespace Tests\Feature;

use App\Services\Report_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportService_Test extends TestCase
{
    protected $reportService;

    public function setUp(): void
    {
        parent::setUP();

        $this->reportService = $this->app->make(Report_service::class);
    }


    public function test_getListCategoryTotalByPeriod()
    {
        $response = $this->reportService->getTotalCategoryListByPeriod('Jan-2023', 'damayanti');

        // print_r($response);

        $this->assertTrue(true);
    }
}
