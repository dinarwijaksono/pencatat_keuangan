<?php

namespace Tests\Feature\Services;

use App\Domains\User_domain;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserService_Test extends TestCase
{
    public $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(User_service::class);
    }


    public function test_register_success()
    {
        $userDomain = new User_domain();
        $userDomain->email = 'test@gmail.com';
        $userDomain->username = 'test';
        $userDomain->password = 'rahasia';

        $this->userService->register($userDomain);;

        $this->assertDatabaseHas('users', [
            'email' => $userDomain->email,
            'username' => $userDomain->username,
        ]);
    }
}
