<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Report_service;
use App\Services\User_service;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;

class Report_controllerApi extends Controller
{
    protected $userService;
    protected $reportService;

    public function __construct(
        User_service $userService,
        Report_service $reportService
    ) {
        $this->userService = $userService;
        $this->reportService = $reportService;
    }

    public function getByUsernameAndPriod(Request $request)
    {
        $validator = validator($request->all(), [
            'username' => 'required|min:4',
            'period' => 'required|min:4',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 401);
        }

        $report = collect($this->reportService->getTotalTransactionInDayByperiod($request->period, $request->type, $request->username));

        $labels = [];
        $value = [];

        foreach ($report as $r) {
            $labels[] = date('j', $r->date / 1000);
            $value[] = $r->total;
        }

        $data = [
            'labels' => $labels,
            'value' => $value
        ];

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
}
