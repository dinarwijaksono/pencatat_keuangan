<?php

namespace Tests\Feature\Services;

use App\Domains\User_domain;
use App\Models\User;
use App\Services\User_service;
use Database\Seeders\User_seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
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


    public function test_login_success()
    {
        $this->seed([User_seeder::class]);

        $username = 'test@gmail.com';
        $password = 'rahasia';

        $response = $this->userService->login($username, $password);

        $this->assertIsBool($response);
        $this->assertTrue($response);
    }


    public function  test_login_failed_emailIsWrong()
    {
        $this->seed([User_seeder::class]);

        $username = 'test111@gmail.com';
        $password = 'rahasia';

        $response = $this->userService->login($username, $password);

        $this->assertIsBool($response);
        $this->assertFalse($response);
    }


    public function test_login_failed_passwordIsWrong()
    {
        $this->seed([User_seeder::class]);

        $username = 'test@gmail.com';
        $password = 'rahasiaasss';

        $response = $this->userService->login($username, $password);

        $this->assertIsBool($response);
        $this->assertFalse($response);
    }
}
