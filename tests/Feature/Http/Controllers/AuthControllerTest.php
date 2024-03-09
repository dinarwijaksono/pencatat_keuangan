<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_do_logout_success(): void
    {
        $this->seed(UserSeeder::class);
        $user  = User::select('*')->where('email', env("USER_EMAIL_TEST"))->first();
        $this->actingAs($user);

        $this->assertEquals(env('USER_EMAIL_TEST'), auth()->user()->email);

        $this->post('/Auth/logout');

        $this->assertNull(auth()->user());
    }
}
