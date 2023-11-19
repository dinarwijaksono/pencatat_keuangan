<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\AddItem;
use App\Models\Category;
use App\Models\User;
use App\Services\Category_service;
use App\Services\User_service;
use Database\Seeders\Category_seeder;
use Database\Seeders\User_seeder;
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

        // create and get user
        $this->seed(User_seeder::class);
        $this->user = User::select('*')->where('username', 'test')->first();

        $this->actingAs($this->user, 'web');

        // create category
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->category = Category::select('*')->where('user_id', $this->user->id)->first();
    }


    public function test_render()
    {
        $this->get("/Transaction/add-item")
            ->assertSeeLivewire('transaction.add-item');
    }


    public function test_doAdditem_success()
    {
        $time = date('Y-m-j', mktime(0, 0, 0, 1, 1, 2023));
        $value = mt_rand(1, 100) * 1000;
        $description = 'example' . mt_rand(1, 100);

        $component = Livewire::test(AddItem::class)
            ->set('date', $time)
            ->set('type', $this->category->type)
            ->set('category', $this->category->id)
            ->set('description', $description)
            ->set('value', $value)
            ->call('doAddItem');

        $this->assertDatabaseHas('transactions', [
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'description' => $description,
        ]);

        $data = [
            'period' => date('M-Y', strtotime($time)),
            'date' => strtotime($time) * 1000,
            'description' => $description,
            'spending' => $this->category->type == 'spending' ? $value : 0,
            'income' => $this->category->type == 'income' ? $value : 0,
        ];

        $this->assertDatabaseHas('transaction_histories', [
            'user_id' => $this->user->id,
            'mode' => 'create',
            'data' => json_encode($data)
        ]);
    }



    public function test_inputIsRequired()
    {
        $component = Livewire::test(AddItem::class)
            ->set('date', '')
            ->set('type', '')
            ->set('category_id', '')
            ->set('description', '')
            ->set('value', '')
            ->call('doAddItem');

        $component->assertHasErrors([
            'date' => 'required',
            'type' => 'required',
            'category' => 'required',
            'description' => 'required',
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
