<?php

namespace App\Livewire\ItemComponen;

use Livewire\Component;

class Alert extends Component
{
    public $color;
    public $message;
    public $display = false;

    protected $listeners = [
        'alertSuccess' => 'success',
        'alertFailed' => 'failed'
    ];

    function success($message)
    {
        $this->color = true;
        $this->message = $message;

        $this->display = true;
    }

    function failed($message)
    {
        $this->color = false;
        $this->message = $message;

        $this->display = true;
    }

    public function render()
    {
        return view('livewire.item-componen.alert');
    }
}
