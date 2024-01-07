<?php

namespace App\Livewire\Report;

use App\Services\Report_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowReportByPeriod extends Component
{
    public $listPeriod;
    public $totalPeriod;
    public $curentIndex;
    public $listTransaction;

    protected $reportService;

    public function boot()
    {
        $this->reportService = App::make(Report_service::class);
        $this->listPeriod = $this->reportService->getPeriodAll();
    }

    public function mount()
    {
        $this->totalPeriod = $this->listPeriod->count();

        $this->curentIndex = $this->totalPeriod - 1;

        $this->listTransaction = $this->reportService->getTotalCategoryListByPeriod($this->listPeriod[$this->curentIndex]);
    }

    public function doPrev()
    {
        if ($this->curentIndex <= 0) {
            $this->curentIndex = 0;
        } else {
            $this->curentIndex--;

            $this->listTransaction = $this->reportService->getTotalCategoryListByPeriod($this->listPeriod[$this->curentIndex]);
        }
    }

    public function doNext()
    {
        if ($this->curentIndex >= ($this->totalPeriod - 1)) {
            $this->curentIndex = $this->totalPeriod - 1;
        } else {
            $this->curentIndex++;

            $this->listTransaction = $this->reportService->getTotalCategoryListByPeriod($this->listPeriod[$this->curentIndex]);
        }
    }

    public function render()
    {
        return view('livewire.report.show-report-by-period');
    }
}
