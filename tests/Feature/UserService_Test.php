<?php

namespace Tests\Feature;

use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserService_Test extends TestCase
{
    public function test_createUser()
    {
        $user = $this->app->make(User_service::class);

        $user->createUser('damayanti', 'damayanti@gmail.com', 'damayanti');

        $this->assertDatabaseHas('users', ['username' => 'damayanti']);
    }
}
