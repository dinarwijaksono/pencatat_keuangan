<?php

namespace Tests\Feature;

use App\Services\Category_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryService_Test extends TestCase
{
    public function test_addCategory()
    {
        $category_service = $this->app->make(Category_service::class);

        $category_service->addCategory(1, 'tagihan', "pengeluaran");

        $this->assertDatabaseHas('categories', ['name' => 'tagihan']);
    }
}
