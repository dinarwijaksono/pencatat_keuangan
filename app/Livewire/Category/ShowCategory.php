<?php

namespace App\Livewire\Category;

use App\Services\Category_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowCategory extends Component
{
    public $listCategory = [];

    protected $categoryService;
    protected $listeners = [
        'doAddCategory' => 'render',
        'doDeleteByCode' => 'render'
    ];

    public function boot()
    {
        $this->categoryService = App::make(Category_service::class);

        $this->listCategory = $this->categoryService->getByUsername(auth()->user()->username);
    }

    public function mount()
    {
        $this->categoryService = App::make(Category_service::class);

        $this->listCategory = $this->categoryService->getByUsername(auth()->user()->username);
    }


    public function doDeleteByCode(string $code)
    {
        $this->categoryService->deleteByCode($code);

        $this->dispatch('doDeleteByCode');
    }


    public function render()
    {
        return view('livewire.category.show-category');
    }
}
