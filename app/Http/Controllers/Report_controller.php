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
        $data['total'] = $this->reportService->getTotalIncomeAndSpending();

        return view('Report/index', $data);
    }
}
