<?php

namespace App\Livewire\Transaction;

use App\Services\CategoryService;
use App\Services\Transaction_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowTransactionByCategory extends Component
{
    public $categoryCode;

    public $category;

    public $listTransaction;

    protected $transactionService;

    protected $listeners = [
        'doDelete' => 'render'
    ];

    public function boot()
    {
        $categoryService = App::make(CategoryService::class);
        $this->category = $categoryService->getByCode($this->categoryCode);

        $this->transactionService = App::make(Transaction_service::class);

        $this->listTransaction = $this->transactionService->getByCategoryId($this->category->id);
    }

    public function doDelete(string $code)
    {
        $this->transactionService->deleteByCode($code);

        $this->dispatch('doDelete');
        $this->dispatch('alertSuccess', "Transaksi berhasil di hapus.");
    }


    public function render()
    {
        return view('livewire.transaction.show-transaction-by-category');
    }
}
