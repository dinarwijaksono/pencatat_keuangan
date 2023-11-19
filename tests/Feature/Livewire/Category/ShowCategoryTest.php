<?php

namespace Tests\Feature\Livewire\Category;

use App\Livewire\Category\ShowCategory;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\Category_seeder;
use Database\Seeders\User_seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(User_seeder::class);

        $user = User::select('*')->where('username', 'test')->first();
        $this->actingAs($user, 'web');
    }

    public function test_renders_successfully()
    {
        $this->get('/Category')
            ->assertSeeLivewire('category.show-category');
    }


    public function test_doDeleteByCode()
    {
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);

        $id = auth()->user()->id;

        $listCategory = Category::select('*')->where('user_id', $id)->get();

        $getCategory = Category::select('code', 'id')->where('user_id', $id)->first();

        $this->assertDatabaseHas('categories', [
            'code' => $getCategory->code,
        ]);

        Livewire::test(ShowCategory::class)
            ->set('listCategory', $listCategory)
            ->call('doDeleteByCode', $getCategory->code);

        $this->assertDatabaseMissing('categories', [
            'code' => $getCategory->code,
        ]);
    }
}
