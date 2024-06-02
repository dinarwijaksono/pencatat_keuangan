<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }



    public function index()
    {
        session()->put('active_menu', 'category');

        return view('Category/index');
    }

    public function detail(string $code)
    {
        $data['category'] = $this->categoryService->getByCode($code);

        return view('Category/detail', $data);
    }
}
