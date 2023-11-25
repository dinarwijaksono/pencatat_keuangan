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
        'alertFailed' => 'render',
        'alertSuccess' => 'render'
    ];

    public function boot()
    {
        $this->categoryService = App::make(Category_service::class);

        $this->listCategory = $this->categoryService->getAll();
    }

    public function mount()
    {
        $this->categoryService = App::make(Category_service::class);

        $this->listCategory = $this->categoryService->getAll();
    }


    public function doDeleteByCode(string $code)
    {
        $result = $this->categoryService->deleteByCode($code);

        if ($result['status']) {
            $this->dispatch('alertSuccess', message: $result['message']);
        } else {
            $this->dispatch('alertFailed', $result['message']);
        }
    }


    public function render()
    {
        return view('livewire.category.show-category');
    }
}
