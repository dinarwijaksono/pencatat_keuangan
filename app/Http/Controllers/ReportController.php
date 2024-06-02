<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        session()->put('active_menu', 'report');

        $data['total'] = $this->reportService->getTotalIncomeAndSpending();

        return view('Report/index', $data);
    }
}
