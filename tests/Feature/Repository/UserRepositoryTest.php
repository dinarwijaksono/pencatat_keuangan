<?php

namespace Tests\Feature\Repository;

use App\Models\User;
use App\Repository\UserRepository;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    public $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->make(UserRepository::class);
    }

    public function test_get_by_id(): void
    {
        $this->seed(UserSeeder::class);

        $user = User::select('*')->first();

        $response = $this->userRepository->getById($user->id);

        $this->assertIsObject($response);
        $this->assertEquals($response->email, 'test@gmail.com');
        $this->assertEquals($response->username, 'test');
    }
}
