<?php

namespace App\Http\Livewire\Transaction;

use App\Services\Category_service;
use App\Services\Transaction_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class AddItem extends Component
{
    public $date;
    public $type;
    public $category_id;
    public $item;
    public $value;

    public $time;

    public $number = 0;

    public $listCategory;

    protected $transactionService;

    protected $rules = [
        'date' => 'required',
        'type' => 'required',
        'category_id' => 'required',
        'item' => 'required',
        'value' => 'required|numeric'
    ];

    public function mount()
    {
        $this->date = date('Y-m-j', $this->time);
        $this->type = 'spending';
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function booted()
    {
        $categoryService = App::make(Category_service::class);
        $this->listCategory = collect($categoryService->getByUsername(session()->get('username')));

        $this->transactionService = App::make(Transaction_service::class);
    }

    public function setNumber()
    {
        if (is_numeric($this->value)) {
            $this->number = $this->value;
        }
    }

    public function doAddItem()
    {
        $this->validate();

        $request = new Request();
        $request['date'] = strtotime($this->date) * 1000;
        $request['type'] = $this->type;
        $request['category_id'] = $this->category_id;
        $request['item'] = $this->item;
        $request['value'] = $this->value;

        $this->transactionService->create($request, session()->get('username'));

        return redirect('/')->with('createTransactionSuccess', 'Berhasil input transaksi');
    }

    public function render()
    {
        return view('livewire.transaction.add-item');
    }
}
