<?php

namespace App\Http\Controllers;

use App\Services\Category_service;
use Illuminate\Http\Request;

class Category_controller extends Controller
{
    public $categoryService;

    public function __construct(Category_service $categoryService)
    {
        $this->categoryService = $categoryService;
    }



    public function index()
    {
        return view('Category/index');
    }


    public function create(Request $request)
    {
        // $request->validate([
        //     'name' => [
        //         'required',
        //         function ($attribute, $value, $fail) {
        //             $user_id = auth()->user()->id;
        //             $category = $this->category_service->getByNameWithUserid($value, $user_id);
        //             if (!empty($category)) {
        //                 $fail("Kategori sudah ada.");
        //             }
        //         }
        //     ],
        //     'type' => [
        //         'required',
        //         function ($attribute, $value, $fail) {
        //             if (!in_array(strtolower($value), ['income', 'spending'])) {
        //                 $fail("$attribute yang kamu inputkan salah.");
        //             }
        //         }
        //     ]
        // ]);

        // $user_id = auth()->user()->id;
        // $this->category_service->addCategory($user_id, $request->name, $request->type);
        // return back()->with('createSuccess', "Kategori $request->name berhasil di buat.");
    }



    public function edit($categoryId)
    {
        $data['category_id'] = $categoryId;

        return view('/Category/edit', $data);
    }



    public function delete(Request $request)
    {
        // $this->category_service->deleteCategory($request->id);

        // return back()->with('deleteSuccess', "Kategori berhasil di hapus.");
    }
}
