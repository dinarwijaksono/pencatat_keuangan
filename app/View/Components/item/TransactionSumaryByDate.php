<?php

namespace App\View\Components\item;

use Illuminate\View\Component;

class TransactionSumaryByDate extends Component
{
    public $transactionSumaryByDate;


    public function __construct(object $transactionSumaryByDate)
    {
        $this->transactionSumaryByDate = $transactionSumaryByDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item.transaction-sumary-by-date');
    }
}
