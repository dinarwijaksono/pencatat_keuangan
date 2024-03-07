<?php

namespace Tests\Feature\Services;

use App\Domains\UserDomain;
use App\Models\User;
use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function test_register_success(): void
    {
        $user = new UserDomain();
        $user->email = 'test@gmail.com';
        $user->username = 'test';
        $user->password = env('USER_PASSWORD_TEST');

        $this->userService->register($user);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'username' => $user->username
        ]);
    }

    public function test_register_failed_email_duplication()
    {
        $this->seed(UserSeeder::class);

        $user = new UserDomain();
        $user->email = 'test@gmail.com';
        $user->username = 'test';
        $user->password = env('USER_PASSWORD_TEST');

        $this->userService->register($user);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'username' => $user->username
        ]);

        $getUser = User::select('*')->where('email', $user->email)->get();
        $this->assertEquals($getUser->count(), 1);
    }
}
