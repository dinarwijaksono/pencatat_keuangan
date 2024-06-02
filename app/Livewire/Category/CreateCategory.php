<?php

namespace App\Livewire\Category;

use App\Domains\Category_domain;
use App\Services\Category_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class CreateCategory extends Component
{
    public $categoryName;
    public $categoryType;

    protected $categoryService;

    public function booted()
    {
        $this->categoryService = App::make(Category_service::class);
    }

    public function doChangeTypeToIncome()
    {
        $this->categoryType = 'income';
    }

    public function doChangeTypeToSpending()
    {
        $this->categoryType = 'spending';
    }

    public function doAddCategory()
    {
        $this->validate([
            'categoryName' => 'required',
            'categoryType' => 'required'
        ]);

        $categoryDomain = new Category_domain(auth()->user()->id);
        $categoryDomain->name = $this->categoryName;
        $categoryDomain->type = $this->categoryType;

        $this->categoryService->addCategory($categoryDomain);

        $this->categoryName = null;
        $this->categoryType = null;

        $this->dispatch('alertSuccess', message: "kategori $this->categoryName berhasil di tambahkan.");
        $this->dispatch('doAddCategory');
    }

    public function render()
    {
        return view('livewire.category.create-category');
    }
}
