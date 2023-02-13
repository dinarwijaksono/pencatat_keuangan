<?php

namespace App\Http\Livewire;

use App\Services\Category_service;
use App\Domains\Transaction_domain;
use App\Services\Transaction_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class AddTransaction extends Component
{
    public $date;
    public $title;
    public $type;
    public $category;
    public $value;

    public $listCategory;

    public function render()
    {
        $categoryService = $this->getCategoryService();
        $list = $categoryService->getListCategory(auth()->user()->id);

        $this->listCategory = $list;

        $income = [];
        $spending = [];
        foreach ($list as $key) {
            if ($key['type'] == 'pemasukan') {
                $income[] = [
                    'id' => $key['id'],
                    'name' => $key['name'],
                    'type' => 'pemasukan'
                ];
            } else {
                $spending[] = [
                    'id' => $key['id'],
                    'name' => $key['name'],
                    'type' => 'pengeluaran'
                ];
            }
        }


        if ($this->type == 'income') {
            $this->listCategory = $income;
        }
        if ($this->type == 'spending') {
            $this->listCategory = $spending;
        }


        return view('livewire.add-transaction');
    }


    public function getCategoryService()
    {
        $categoryService = App::make(Category_service::class);

        return $categoryService;
    }

    protected $rules = [
        'date' => 'required',
        'title' => 'required',
        'category' => 'required',
        'type' => 'required',
        'value' => 'numeric'
    ];


    public function updated($value)
    {
        $this->validateOnly($value);
    }


    public function addTransaction()
    {
        $this->validate();

        $transaction_domain = App::make(Transaction_domain::class);
        $transaction_service = App::make(Transaction_service::class);

        $transaction = $transaction_domain;
        $transaction->date = strtotime($this->date);
        $transaction->category_id = $this->category;
        $transaction->type = $this->type;
        $transaction->value = $this->value;
        $transaction->title = $this->title;
        $transaction->user_id = auth()->user()->id;
        $transaction->period = date('F-Y', strtotime($this->date));

        $transaction_service->addTransaction($transaction);

        return redirect('/')->with('createTransactionSuccess', 'Transaksi berhasil di buat.');
    }
}
