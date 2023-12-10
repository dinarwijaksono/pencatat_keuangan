<?php

namespace App\Livewire\Transaction;

use App\Domains\Transaction_domain;
use App\Services\Category_service;
use App\Services\Transaction_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class EditTransaction extends Component
{
    public $code;
    public $time;
    public $type;
    public $category_id;
    public $value;
    public $description;

    public $number;
    public $listCategory;

    protected $transactionService;

    public function booted()
    {
        $categoryService = App::make(Category_service::class);

        $this->listCategory = $categoryService->getAll();

        $this->transactionService = App::make(Transaction_service::class);
    }

    public function mount()
    {
        $this->transactionService = App::make(Transaction_service::class);

        $getTransaciton = $this->transactionService->getByCode($this->code);

        $this->time = date('Y-m-d', $getTransaciton->date / 1000);
        $this->type = $getTransaciton->category_type;
        $this->category_id = $getTransaciton->category_id;
        $this->value = $getTransaciton->income == 0 ? $getTransaciton->spending : $getTransaciton->income;
        $this->description = $getTransaciton->description;

        $this->number = $this->value;
    }


    public function setNumber()
    {
        if (is_numeric($this->value)) {
            $this->number = $this->value;
        } else {
            $this->number = 0;
        }
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function doUpdate()
    {
        $this->validate([
            'time' => 'required',
            'type' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'value' =>  'required|numeric'
        ]);

        $transacitonDomain = new Transaction_domain();
        $transacitonDomain->categoryId = $this->category_id;
        $transacitonDomain->date = strtotime($this->time) * 1000;
        $transacitonDomain->description = $this->description;
        $transacitonDomain->spending = $this->type == 'spending' ? $this->value : 0;
        $transacitonDomain->income = $this->type == 'indome' ? $this->value : 0;

        $this->transactionService->update($this->code, $transacitonDomain);

        return redirect('/')->with('allertSuccess', 'Transaksi berhasil di update.');
    }


    public function render()
    {
        return view('livewire.transaction.edit-transaction');
    }
}
