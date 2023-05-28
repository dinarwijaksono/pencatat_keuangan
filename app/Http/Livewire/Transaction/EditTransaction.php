<?php

namespace App\Http\Livewire\Transaction;

use App\Services\Category_service;
use App\Services\Transaction_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class EditTransaction extends Component
{
    public $code;

    protected $transactionService;

    public $listCategory;

    public $date;
    public $type;
    public $category_id;
    public $item;
    public $value;

    public $rules = [
        'date' => 'required',
        'type' => 'required',
        'category_id' => 'required',
        'item' => 'required',
        'value' =>  'required|numeric'
    ];

    public function booted()
    {
        $categoryService = App::make(Category_service::class);
        $this->listCategory = collect($categoryService->getByUsername(session()->get('username')));

        $this->transactionService = App::make(Transaction_service::class);
    }

    public function mount()
    {
        $this->transactionService = App::make(Transaction_service::class);

        $getItem = $this->transactionService->getByCode($this->code);

        $this->date = date('Y-m-j', $getItem->date / 1000);
        $this->type = $getItem->type;
        $this->category_id = $getItem->category_id;
        $this->item = $getItem->item;
        $this->value = $getItem->value;
    }


    public function doUpdate()
    {
        $this->validate();

        $request = new Request();
        $request['code'] = $this->code;
        $request['category_id'] = $this->category_id;
        $request['date'] = strtotime($this->date) * 1000;
        $request['type'] = $this->type;
        $request['item'] = $this->item;
        $request['value'] = $this->value;

        $this->transactionService->update($request, session()->get('username'));

        return redirect('/')->with('updateTransactionSuccess', 'Transaksi berhasil di update.');
    }


    public function render()
    {
        return view('livewire.transaction.edit-transaction');
    }
}
