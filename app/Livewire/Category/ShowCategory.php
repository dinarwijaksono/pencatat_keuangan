<?php

namespace App\Livewire\Category;

use App\Services\Category_service;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Attributes\On;

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

    public function doDeleteByCode(string $code)
    {
        $result = $this->categoryService->deleteByCode($code);

        if (true) {
            $this->dispatch('alertSuccess', $result['message']);

            return redirect('/Category');
        } else {
            $this->dispatch('alertFailed', $result['message']);
        }
    }

    public function render()
    {
        return view('livewire.category.show-category');
    }
}
