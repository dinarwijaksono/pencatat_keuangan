<?php

namespace App\Http\Livewire\Category;

use App\Services\Category_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowCategory extends Component
{
    public $listCategory;


    public function mount()
    {
        $category_service = App::make(Category_service::class);

        $user_id = auth()->user()->id;
        $this->listCategory = $category_service->getlistCategory($user_id);
    }

    public function render()
    {
        return view('livewire.category.show-category');
    }
}
