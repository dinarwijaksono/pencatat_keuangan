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
    protected $listeners = [
        'doAddCategory' => 'render',
        'doDeleteByCode' => 'render'
    ];

    public function booted()
    {
        $this->categoryService = App::make(Category_service::class);

        $this->listCategory = collect($this->categoryService->getByUsername(session()->get('username')));
    }


    public function doDeleteByCode(string $code)
    {
        $this->categoryService->deleteByCode($code);

        $this->emit('doDeleteByCode', 'doDeleteByCode');
    }


    public function render($message = null)
    {
        if ($message == 'doDeleteByCode') {
            session()->flash('deleteCategorySuccess', 'Kategori berhasil di hapus.');
        }

        return view('livewire.category.show-category');
    }
}
