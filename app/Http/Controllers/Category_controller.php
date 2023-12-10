<?php

namespace App\Http\Controllers;

use App\Services\Category_service;

class Category_controller extends Controller
{
    protected $categoryService;

    public function __construct(Category_service $categoryService)
    {
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
