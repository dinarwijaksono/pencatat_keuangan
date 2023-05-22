<?php

namespace App\Http\Livewire\Category;

use App\Services\Category_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowCategory extends Component
{
    public $listCategory = [];

    public $buttonActive = 'income';
    public $buttonAll = false;

    protected $categoryService;
    protected $listeners = ['doAddCategory' => 'render'];

    public function booted()
    {
        $this->categoryService = App::make(Category_service::class);

        $this->listCategory = collect($this->categoryService->getByUsername(session()->get('username')));
    }

    public function render()
    {
        return view('livewire.category.show-category');
    }
}
