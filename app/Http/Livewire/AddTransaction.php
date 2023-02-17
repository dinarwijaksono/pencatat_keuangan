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
    public $type = 'spending';
    public $category;
    public $value;

    public $income;
    public $spending;





    public function render()
    {
        $this->date = date('Y-m-d', time());

        $categoryService = $this->getCategoryService();
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


    public function updated($paramValue)
    {
        $this->validateOnly($paramValue);
    }


    public function addTransaction()
    {
        $this->validate();

        $transaction_domain = App::make(Transaction_domain::class);
        $transaction_service = App::make(Transaction_service::class);

        $category_service = $this->getCategoryService();

        $getCategory = $category_service->getByIdWithUserId($this->category, auth()->user()->id);

        $transaction = $transaction_domain;
        $transaction->date = strtotime($this->date);
        $transaction->category_id = $this->category;
        $transaction->type = $getCategory['type'];
        $transaction->value = $this->value;
        $transaction->title = $this->title;
        $transaction->user_id = auth()->user()->id;
        $transaction->period = date('F-Y', strtotime($this->date));

        $transaction_service->addTransaction($transaction);

        return redirect('/')->with('createTransactionSuccess', 'Transaksi berhasil di buat.');
    }
}
