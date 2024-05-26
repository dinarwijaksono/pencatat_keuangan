<?php

namespace App\Livewire\ImportExport;

use App\Services\ReportService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class BoxExport extends Component
{
    public $listPeriod;

    public function boot()
    {
        $reportService = App::make(ReportService::class);

        $this->listPeriod = $reportService->getListPeriod();
    }

    public function render()
    {
        return view('livewire.import-export.box-export');
    }
}
