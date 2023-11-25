<?php

namespace App\Livewire\ItemComponen;

use App\Services\Transaction_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TransactionInDay extends Component
{
    public $time;
    public $listTransactionInDay;

    protected $transactionService;

    protected $listeners = [
        'doDelete' => 'render'
    ];

    public function booted()
    {
        $this->transactionService = App::make(Transaction_service::class);

        $this->listTransactionInDay = $this->transactionService->getByDate($this->time);
    }

    public function doDelete(string $code)
    {
        $this->transactionService->deleteByCode($code);

        $this->dispatch('doDelete');
        $this->dispatch('alertSuccess', message: "Transaksi berhasil di hapus.");
    }


    public function render()
    {
        return view('livewire.item-componen.transaction-in-day');
    }
}
