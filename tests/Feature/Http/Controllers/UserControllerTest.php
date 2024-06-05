<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->user  = User::select('*')->first();
        $this->actingAs($this->user);
    }

    public function test_get_profile(): void
    {
        $response = $this->get('/profile');

        $response->assertStatus(200);
        $response->assertSee('Profile');
        $response->assertSee($this->user->username);
        $response->assertSee($this->user->email);
    }
}
