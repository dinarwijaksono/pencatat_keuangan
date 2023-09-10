<?php

namespace App\Livewire\Transaction;

use App\Domains\Transaction_domain;
use App\Services\Transaction_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TransactionDetail extends Component
{
    public $date;
    public $listItem;
    public int $todayIncome = 0;
    public int $todaySpending = 0;

    protected $transaction_domain;
    protected $transaction_service;
    protected $user_id;

    public function mount()
    {
        $this->user_id = auth()->user()->id;
        $this->transaction_domain = App::make(Transaction_domain::class);
        $this->transaction_service = App::make(Transaction_service::class);

        $transaction_domain = $this->transaction_domain;
        $transaction_domain->user_id = $this->user_id;
        $transaction_domain->date = $this->date;

        $this->listItem = $this->transaction_service->getByDateWithUserid($transaction_domain);

        foreach ($this->listItem as $item) {
            if ($item['type'] == 'income') {
                $this->todayIncome += $item['value'];
            } else {
                $this->todaySpending += $item['value'];
            }
        }
    }

    public function deleteItem($itemId)
    {
        $transaction_service = App::make(Transaction_service::class);
        $transaction_service->deleteById($itemId);

        session()->flash('deleteSuccess', "Item berhasil di hapus");
    }

    public function render()
    {
        return view('livewire.transaction.transaction-detail');
    }
}
