<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        session()->put('active_menu', 'category');

        $this->categoryService = $categoryService;
    }



    public function index()
    {
        return view('Category/index');
    }

    public function detail(string $code)
    {
        $data['category'] = $this->categoryService->getByCode($code);

        return view('Category/detail', $data);
    }
}
