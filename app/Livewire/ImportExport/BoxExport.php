<?php

namespace App\Livewire\ImportExport;

use App\Services\ExportService;
use App\Services\ReportService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BoxExport extends Component
{
    public $listPeriod;

    public $period;

    protected $exportService;
    protected $transactionService;

    public function getRules()
    {
        return [
            'period' => 'required'
        ];
    }

    public function boot()
    {
        Log::withContext([
            'class' => BoxExport::class,
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
        ]);

        $this->exportService = App::make(ExportService::class);
        $this->transactionService = App::make(TransactionService::class);

        $reportService = App::make(ReportService::class);

        $this->listPeriod = $reportService->getListPeriod();
    }

    public function doExport()
    {
        $this->validate();

        try {
            if ($this->period == 'all') {
                $transactions = $this->transactionService->getTransactionDetailAll(auth()->user()->id);
            } else {
                $transactions = $this->transactionService->getTransactionDetailByPeriod(auth()->user()->id, $this->period);
            }

            $this->exportService->export(auth()->user()->username, $transactions);

            $username = auth()->user()->username;
            $file = url("storage/Export/$username-transaction-export.csv");

            Log::info('do export success');

            return redirect($file);
        } catch (\Throwable $th) {
            Log::error('Do export failed', [
                'message' => $th->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.import-export.box-export');
    }
}
