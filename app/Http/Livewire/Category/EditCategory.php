<?php

namespace App\Http\Livewire\Category;

use App\Services\Category_service;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditCategory extends Component
{
    public $category_id;
    public $name;
    public $type;

    protected $category_service;

    public function mount()
    {
        $user_id = auth()->user()->id;
        $category_service = App::make(Category_service::class);
        $category = $category_service->getByIdWithUserId($this->category_id, $user_id);

        $this->name = $category['name'];
        $this->type = $category['type'];
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', 'min:4']
        ]);

        $data['name'] = $this->name;

        $category_service = App::make(Category_service::class);

        $update = $category_service->edit($this->category_id, $data);
        if ($update) {
            return redirect('/Category/index')->with('updateSuccess', "Kategori berhasil di edit.");
        } else {
            return back()->with('updateFailed', "Kategori sudah ada.");
        }
    }

    public function render()
    {
        return view('livewire.category.edit-category');
    }
}
