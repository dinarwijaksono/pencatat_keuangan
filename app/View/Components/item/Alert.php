<?php

namespace App\View\Components\item;

use Illuminate\View\Component;

class Alert extends Component
{
    public $color;
    public $message;

    public function __construct(string $color = 'danger', string $message = 'this is message')
    {
        $this->color = $color;
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
