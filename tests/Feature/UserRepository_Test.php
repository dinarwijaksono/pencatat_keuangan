<?php

namespace Tests\Feature;

use App\Repository\User_repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRepository_Test extends TestCase
{
    public $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        $this->userRepository = $this->app->make(User_repository::class);
    }

    public function test_create_success()
    {
        $username = 'user-' . mt_rand(1, 9999);
        $password = 'rahasia-' . mt_rand(1, 9999);
        $this->userRepository->create($username, $password);

        $this->assertDatabaseHas('users', ['username' => $username]);
    }


    public function test_getByUsername_success()
    {
        // create
        $username = 'user-' . mt_rand(1, 9999);
        $password = 'rahasia-' . mt_rand(1, 9999);
        $this->userRepository->create($username, $password);

        // getByUsername
        $response = $this->userRepository->getByUsername($username);

        $this->assertIsObject($response);
        $this->assertEquals($username, $response->username);
        $this->assertNotEquals($password, $response->password);
        $this->assertTrue(Hash::check($password, $response->password));
    }
}
