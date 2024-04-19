<?php

namespace App\Livewire\ItemComponen;

use Livewire\Component;

class Alert extends Component
{
    public $status;
    public $message;
    public $isHiden;

    protected $listeners = [
        'alertSuccess' => 'success',
        'alertFailed' => 'failed'
    ];

    public function mount()
    {
        $this->isHiden = true;
    }

    public function doHiden()
    {
        $this->isHiden = true;
    }

    public function success($message)
    {
        $this->status = 'success';
        $this->message = $message;

        $this->isHiden = false;
    }

    public function failed($message)
    {
        $this->status = 'failed';
        $this->message = $message;

        $this->isHiden = false;
    }

    public function render()
    {
        return view('livewire.item-componen.alert');
    }
}
