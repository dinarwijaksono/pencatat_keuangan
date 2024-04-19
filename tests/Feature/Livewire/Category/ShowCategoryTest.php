<?php

namespace Tests\Feature\Livewire\Category;

use App\Livewire\Category\ShowCategory;
use App\Livewire\ItemComponen\Alert;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\Category_seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\User_seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(User_seeder::class);

        $this->user = User::select('*')->where('username', 'test')->first();
        $this->actingAs($this->user, 'web');
    }

    public function test_renders_successfully()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::select('name')->where('user_id', $this->user->id)->first();

        $this->get('/Category')
            ->assertSeeLivewire('category.show-category')
            ->assertSee($category->name);
    }


    public function test_do_delete_by_code_success()
    {
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);

        $listCategory = Category::select('*')->where('user_id', $this->user->id)->get();

        $getCategory = Category::select('code', 'id')->where('user_id', $this->user->id)->first();

        $this->assertDatabaseHas('categories', [
            'code' => $getCategory->code,
        ]);

        Livewire::test(ShowCategory::class)
            ->set('listCategory', $listCategory)
            ->call('doDeleteByCode', $getCategory->code)
            ->assertDispatchedTo(Alert::class, 'alertSuccess')
            ->assertDispatched('refresh-list-category');

        $this->assertDatabaseMissing('categories', [
            'code' => $getCategory->code,
        ]);
    }
}
