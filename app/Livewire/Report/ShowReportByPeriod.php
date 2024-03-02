<?php

namespace App\Livewire\Report;

use App\Services\ReportService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowReportByPeriod extends Component
{
    public $listPeriod;
    public int $totalPeriod;
    public int $curentIndex = 0;
    public $listTransaction;

    protected $reportService;
    protected $reportServiceNew;

    public function boot()
    {
        $this->reportService = App::make(ReportService::class);
        $this->listTransaction = collect([]);
    }

    public function mount()
    {
        $this->listPeriod = $this->reportService->getListPeriod();
        $this->totalPeriod = count($this->listPeriod);

        if ($this->totalPeriod !== 0) {

            $this->curentIndex = $this->totalPeriod - 1;

            $this->listTransaction = $this->reportService->getTotalCategoryListByPeriod(
                $this->listPeriod[$this->curentIndex]
            );
        }
    }

    public function doPrev()
    {
        if ($this->curentIndex <= 0) {
            $this->curentIndex = 0;
        } else {
            $this->curentIndex--;
        }

        $this->listTransaction = $this->reportService->getTotalCategoryListByPeriod(
            $this->listPeriod[$this->curentIndex]
        );
    }

    public function doNext()
    {
        if ($this->curentIndex >= ($this->totalPeriod - 1)) {
            $this->curentIndex = $this->totalPeriod - 1;
        } else {
            $this->curentIndex++;
        }

        $this->listTransaction = $this->reportService->getTotalCategoryListByPeriod(
            $this->listPeriod[$this->curentIndex]
        );
    }

    public function render()
    {
        return view('livewire.report.show-report-by-period');
    }
}
