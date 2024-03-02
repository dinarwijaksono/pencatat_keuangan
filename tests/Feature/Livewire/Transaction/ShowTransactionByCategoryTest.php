<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\ShowTransactionByCategory;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowTransactionByCategoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::select('*')->first();
        $this->actingAs($user);

        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
    }

    /** @test */
    public function renders_successfully()
    {
        $this->seed(TransactionSeeder::class);

        $category = Category::select('*')->first();

        $response = $this->get('/Category/detail/' . $category->code);

        $response->assertStatus(200);
    }
}
