<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\AddItem;
use App\Services\Category_service;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Tests\TestCase;

class AddItemTest extends TestCase
{
    protected $user;
    protected $category;

    public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'mysql-test']);

        // create user
        $userService = $this->app->make(User_service::class);

        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'Rahasia';
        $userService->register($request);

        $this->user = $userService->getByUsername($request->username);

        // create category
        $categoryService = $this->app->make(Category_service::class);
        $requestCategory = new Request();
        $requestCategory['name'] = 'contoh-' . mt_rand(1, 9999);
        $requestCategory['type'] = 'spending';
        $categoryService->addCategory($requestCategory, $this->user->username);

        $this->category = collect($categoryService->getByUsername($this->user->username))->first();
    }


    public function test_render()
    {
        session()->put('username', $this->user->username);

        $time = time();
        $this->get("/Transaction/addItem/$time")
            ->assertSeeLivewire('transaction.add-item');
    }


    public function test_doAdditem_success()
    {
        session()->put('username', $this->user->username);

        $time = 12983;
        $type = $this->category->type;
        $category_id = $this->category->id;
        $item = 'contoh-' . mt_rand(1, 99999);
        $value = mt_rand(1, 999) * 500;

        $component = Livewire::test(AddItem::class)
            ->set('date', $time)
            ->set('type', $type)
            ->set('category_id', $category_id)
            ->set('item', $item)
            ->set('value', $value)
            ->call('doAddItem');

        $this->assertDatabaseHas('transactions', [
            'user_id' => $this->user->id,
            'item' => $item,
            'category_id' => $category_id,
        ]);
    }



    public function test_inputIsRequired()
    {
        session()->put('username', $this->user->username);

        $component = Livewire::test(AddItem::class)
            ->set('date', '')
            ->set('type', '')
            ->set('category_id', '')
            ->set('item', '')
            ->set('value', '')
            ->call('doAddItem');

        $component->assertHasErrors([
            'date' => 'required',
            'type' => 'required',
            'category_id' => 'required',
            'item' => 'required',
            'value' => 'required',
        ]);
    }


    public function test_valueIsNumeric()
    {
        session()->put('username', $this->user->username);

        $component = Livewire::test(AddItem::class)
            ->set('value', 'asdlkfj')
            ->call('doAddItem');

        $component->assertHasErrors([
            'value' => 'numeric',
        ]);
    }
}
