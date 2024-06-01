<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Sidebar extends Component
{
    public $isHidden = true;

    public function doTogle()
    {
        $this->isHidden = !$this->isHidden;
    }

    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
