<?php

namespace Tests\Feature\Livewire\Components;

use App\Livewire\Components\Sidebar;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SidebarTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::select('*')->first();
        $this->actingAs($user);
    }

    public function test_renders_successfully()
    {
        Livewire::test(Sidebar::class)
            ->assertStatus(200);
    }
}
