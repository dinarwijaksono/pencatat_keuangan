<?php

namespace App\Http\Livewire\Home;

use App\Domains\Transaction_domain;
use App\Services\Transaction_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowTodayTransaction extends Component
{
    public $todayTransaction;
    public $todayTotal = [];

    protected $user;
    protected $transaction_domain;
    protected $transaction_service;

    function mount()
    {
        $this->user = auth()->user();

        $this->transaction_domain = App::make(Transaction_domain::class);
        $this->transaction_service = App::make(Transaction_service::class);

        $transaction = $this->transaction_domain;
        $transaction->date = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
        $transaction->user_id = $this->user->id;

        $this->todayTransaction = $this->transaction_service->getByDateWithUserid($transaction);

        $totalIncomeToday = 0;
        $totalSpendingToday = 0;
        foreach ($this->todayTransaction as $transaction) {
            if ($transaction['type'] == 'income') {
                $totalIncomeToday += $transaction['value'];
            } else {
                $totalSpendingToday += $transaction['value'];
            }
        }

        $this->todayTotal = [
            'income' => $totalIncomeToday,
            'spending' => $totalSpendingToday
        ];
    }

    public function render()
    {
        return view('livewire.home.show-today-transaction');
    }


    public function deleteItem($itemId)
    {
        $transaction_service = App::make(Transaction_service::class);
        $transaction_service->deleteById($itemId);

        return redirect('/')->with('deleteSuccess', "Item berhasil di hapus");
    }
}
