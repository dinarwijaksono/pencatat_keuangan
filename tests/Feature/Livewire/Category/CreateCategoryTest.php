<?php

namespace Tests\Feature\Livewire\Category;

use App\Livewire\Category\CreateCategory;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        $userService = $this->app->make(User_service::class);

        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'Rahasia';
        $userService->register($request);

        $this->user = $userService->getByUsername($request->username);
    }


    public function test_render()
    {
        session()->put('username', $this->user->username);

        $this->get('/Category')
            ->assertSeeLivewire('category.create-category');
    }

    public function test_doAddCategory()
    {
        $name = 'contoh-' . mt_rand(1, 9999);
        $type = array_rand(['spending', 'income']);

        session()->put('username', $this->user->username);

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
        session()->put('username', $this->user->username);

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
