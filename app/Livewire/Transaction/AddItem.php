<?php

namespace App\Livewire\Transaction;

use App\Domains\Transaction_domain;
use App\Services\Category_service;
use App\Services\Transaction_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddItem extends Component
{
    public $date;
    public $type;
    public $category;

    #[Validate]
    public $description;
    public $value;

    public $time;

    public $number = 0;

    public $listCategory;

    protected $transactionService;

    public function mount()
    {
        $this->date = date('Y-m-d', $this->time / 1000);
        $this->type = 'income';
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function booted()
    {
        $categoryService = App::make(Category_service::class);
        $this->listCategory = $categoryService->getAll();

        $this->transactionService = App::make(Transaction_service::class);
    }

    public function setNumber()
    {
        if (is_numeric($this->value)) {
            $this->number = $this->value;
        }
    }

    public function rules()
    {
        return [
            'date' => 'required',
            'type' => 'required',
            'category' => 'required',
            'description' => 'required|min:4',
            'value' => 'required|numeric'
        ];
    }

    public function doAddItem()
    {
        $this->validate();

        $transaction = new Transaction_domain();
        $transaction->categoryId = $this->category;
        $transaction->date = strtotime($this->date) * 1000;
        $transaction->description = $this->description;
        $transaction->spending = $this->type == 'spending' ? $this->value : 0;
        $transaction->income = $this->type == 'income' ? $this->value : 0;

        $this->transactionService->create($transaction);

        return redirect('/')->with('allertSuccess', 'Transaksi berhasil di simpan.');
    }

    public function render()
    {
        return view('livewire.transaction.add-item');
    }
}
