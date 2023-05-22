<?php

namespace App\Http\Livewire\Category;

use App\Services\Category_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class CreateCategory extends Component
{
    public $categoryName;
    public $categoryType;

    protected $rules = [
        'categoryName' => 'required',
        'categoryType' => 'required'
    ];

    protected $categoryService;

    public function booted()
    {
        $this->categoryService = App::make(Category_service::class);
    }

    public function doAddCategory()
    {
        $this->validate();

        $request = new Request();
        $request['name'] = $this->categoryName;
        $request['type'] = $this->categoryType;

        $this->categoryService->addCategory($request, session()->get('username'));

        session()->flash('createCategorySuccess', "Kategori $request->name berhasil di tambahkan.");
        $this->emit('doAddCategory');
    }

    public function render()
    {
        return view('livewire.category.create-category');
    }
}
