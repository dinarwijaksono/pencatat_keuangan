<?php

namespace App\Livewire\Category;

use App\Livewire\ItemComponen\Alert;
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
        'alertSuccess' => 'render',
        'refresh-list-category' => 'render'
    ];

    public function boot()
    {
        $this->categoryService = App::make(Category_service::class);

        $this->listCategory = $this->categoryService->getAll();
    }

    public function doDeleteByCode(string $code)
    {
        $result = $this->categoryService->deleteByCode($code);

        if ($result['status']) {
            $this->dispatch('alertSuccess', $result['message'])->to(Alert::class);
            $this->dispatch('refresh-list-category')->self();
        } else {
            $this->dispatch('alertFailed', $result['message'])->to(Alert::class);
        }
    }

    public function render()
    {
        return view('livewire.category.show-category');
    }
}
