<?php

namespace App\Http\Livewire\Transaction;

use App\Domains\Transaction_domain;
use App\Services\Category_service;
use App\Services\Transaction_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class EditTransaction extends Component
{
    public $date;
    public $title;
    public $type;
    public $category;
    public $category_id;
    public $value;
    public $income;
    public $spending;
    public $itemId;
    public $item;

    protected $category_service;

    public function mount()
    {
        $this->date = $this->item['date'];
        $this->title = $this->item['title'];
        $this->type = $this->item['type'];
        $this->category_id = $this->item['category_id'];
        $this->value = $this->item['value'];

        $this->category_service = App::make(Category_service::class);

        $categoryService = $this->category_service;
        $list = $categoryService->getListCategory(auth()->user()->id);

        $this->income = [];
        $this->spending = [];
        foreach ($list as $key) {
            if ($key['type'] == 'income') {
                $this->income[] = [
                    'id' => $key['id'],
                    'name' => $key['name'],
                    'type' => 'income'
                ];
            } else {
                $this->spending[] = [
                    'id' => $key['id'],
                    'name' => $key['name'],
                    'type' => 'spending'
                ];
            }
        }
    }


    public function editTransaction()
    {
        $this->validate([
            'date' => 'required',
            'title' => 'required',
            'category' => 'required',
            'type' => 'required',
            'value' => 'numeric'
        ]);

        $transaction_domain = App::make(Transaction_domain::class);
        $transaction_domain->id = $this->itemId;
        $transaction_domain->user_id = auth()->user()->id;
        $transaction_domain->category_id = $this->category;
        $transaction_domain->title = $this->title;
        $transaction_domain->period = date('F-Y', strtotime($this->date));
        $transaction_domain->date = strtotime($this->date);
        $transaction_domain->type = $this->type;
        $transaction_domain->value = $this->value;

        $transaction_service = App::make(Transaction_service::class);
        $transaction_service->update($transaction_domain);

        return redirect('/')->with('updateSuccess', 'Transaksi berhasil di edit.');
    }


    public function render()
    {
        if (!is_int($this->date)) {
            $this->date = strtotime($this->date);
        }

        $this->date = date('Y-m-d', $this->date);

        if (is_null($this->category)) {
            $this->category = $this->category_id;
        }


        return view('livewire.transaction.edit-transaction');
    }
}
