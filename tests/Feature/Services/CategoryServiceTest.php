<?php

namespace Tests\Feature\Services;

use App\Models\Category;
use App\Models\User;
use App\Services\CategoryService;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    public $user;
    public $categoryService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->user = User::select('*')->first();
        $this->actingAs($this->user);

        $this->categoryService = $this->app->make(CategoryService::class);

        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
    }

    public function test_get_by_code(): void
    {
        $category = Category::select('*')->first();

        $response = $this->categoryService->getByCode($category->code);

        $this->assertEquals($category->name, $response->name);
        $this->assertEquals($category->type, $response->type);
    }
}
