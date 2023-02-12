<?php

namespace App\Http\Controllers;

use App\Domains\Transaction_domain;
use Illuminate\Http\Request;
use App\Services\Category_service;
use App\Services\Transaction_service;

class Transaction_controller extends Controller
{
    protected $transaction_domain;
    protected $transaction_service;
    protected $catetegory_service;

    public function __construct(Transaction_service $transaction_service, Transaction_domain $transaction_domain, Category_service $category_service)
    {
        $this->transaction_domain = $transaction_domain;
        $this->transaction_service = $transaction_service;
        $this->catetegory_service = $category_service;
    }


    public function addTransaction()
    {
        $user_id = auth()->user()->id;
        $data['listCategory'] = $this->catetegory_service->getAllCategory($user_id);

        return view('Transaction/addItem', $data);
    }

    public function storeTransaction(Request $request)
    {
        // Validasi
        $request->validate([
            'date' => 'required',
            'category' => 'required',
            'value' => 'required',
            'title' => 'required|max:50'
        ]);

        $user_id = auth()->user()->id;
        $category = $this->catetegory_service->getByNameWithUserid($request->category, $user_id);

        $transaction = $this->transaction_domain;
        $transaction->date = strtotime($request->date);
        $transaction->category_id = $category['id'];
        $transaction->type = $category['type'];
        $transaction->value = $request->value;
        $transaction->title = $request->title;
        $transaction->user_id = $user_id;
        $transaction->period = date('F-Y');

        $this->transaction_service->addTransaction($transaction);

        return back();
    }



    public function transactionDetail()
    {
        return view('Transaction/transactionDetail');
    }
}
