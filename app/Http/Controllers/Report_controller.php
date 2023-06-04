<?php

namespace App\Http\Controllers;

use App\Services\Report_service;
use Illuminate\Http\Request;

class Report_controller extends Controller
{
    protected $reportService;

    public function __construct(Report_service $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        $period = "Jan-2023";

        $data['transactionTotal'] = $this->reportService->getTotalIncomeAndSpending(session()->get('username'));
        $data['totalCategoryList'] = collect($this->reportService->getTotalCategoryListByPeriod($period, session()->get('username')));

        return view('Report/index', $data);
    }
}
