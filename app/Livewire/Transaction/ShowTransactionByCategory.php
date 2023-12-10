<?php

namespace App\Livewire\Transaction;

use App\Services\Transaction_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowTransactionByCategory extends Component
{
    public $categoryId;

    public $listTransaction;

    protected $transactionService;

    protected $listeners = [
        'doDelete' => 'render'
    ];

    public function boot()
    {
        $this->transactionService = App::make(Transaction_service::class);

        $this->listTransaction = $this->transactionService->getByCategoryId($this->categoryId);
    }

    public function doDelete(string $code)
    {
        $this->transactionService->deleteByCode($code);

        $this->dispatch('doDelete');
        $this->dispatch('alertSuccess', "Kategori berhasil dihapus.");
    }


    public function render()
    {
        return view('livewire.transaction.show-transaction-by-category');
    }
}
