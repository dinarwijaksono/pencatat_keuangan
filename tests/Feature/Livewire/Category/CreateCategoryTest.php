<?php

namespace Tests\Feature\Livewire\Category;

use App\Livewire\Category\CreateCategory;
use App\Models\User;
use App\Services\User_service;
use Database\Seeders\User_seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    public function test_render()
    {
        $this->seed(User_seeder::class);

        $user = User::select('*')->where('username', 'test')->first();

        $this->actingAs($user, 'web');

        $this->get('/Category')
            ->assertSeeLivewire('category.create-category');
    }

    public function test_doAddCategory()
    {
        $name = 'contoh-' . mt_rand(1, 9999);
        $type = array_rand(['spending', 'income']);

        $this->seed(User_seeder::class);
        $user = User::select('*')->where('username', 'test')->first();

        $this->actingAs($user, 'web');

        Livewire::test(CreateCategory::class)
            ->set('categoryName', $name)
            ->set('categoryType', $type)
            ->call('doAddCategory');

        $this->assertDatabaseHas('categories', [
            'name' => $name,
            'type' => $type
        ]);
    }


    public function test_inputIsRequired()
    {
        $this->seed(User_seeder::class);
        $user = User::select('*')->where('username', 'test')->first();

        $this->actingAs($user, 'web');

        $component = Livewire::test(CreateCategory::class)
            ->set('categoryName', '')
            ->set('categoryType', '')
            ->call('doAddCategory');

        $component->assertHasErrors([
            'categoryName' => 'required',
            'categoryType' => 'required'
        ]);
    }
}
