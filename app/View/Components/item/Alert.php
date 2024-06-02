<?php

namespace App\View\Components\item;

use Illuminate\View\Component;

class Alert extends Component
{
    public $status;
    public $message;

    public function __construct(string $status = 'success', string $message = 'this is message')
    {
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item.alert');
    }
}
