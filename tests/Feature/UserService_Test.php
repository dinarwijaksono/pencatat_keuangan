<?php

namespace Tests\Feature;

use App\Exceptions\Validate_exception;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserService_Test extends TestCase
{
    public $userService;

    public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'mysql-test']);

        $this->userService = $this->app->make(User_service::class);
    }

    public function test_register_success()
    {
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'rahasia-' . mt_rand(1, 9999);

        $this->userService->register($request);

        $this->assertDatabaseHas('users', ['username' => $request->username]);
    }


    public function test_register_failed_usernameAndPasswordIsBlank()
    {
        $this->expectException(Validate_exception::class);

        $request = new Request();
        $request['username'] = "";
        $request['password'] = "";

        $this->userService->register($request);

        $this->expectExceptionMessage("username / password is blank.");
    }


    public function test_register_failed_blankUsername()
    {
        $this->expectException(Validate_exception::class);

        $request = new Request();
        $request['username'] = "";
        $request['password'] = "rahasia";

        $this->userService->register($request);

        $this->expectExceptionMessage("username / password is blank.");
        $this->assertDatabaseMissing('users', ['username' => $request['username']]);
    }

    public function test_register_failed_blankPassword()
    {
        $this->expectException(Validate_exception::class);

        $request = new Request();
        $request['username'] = "contoh-" . mt_rand(1, 99999);
        $request['password'] = '';

        $this->userService->register($request);

        $this->expectExceptionMessage("username / password is blank.");
        $this->assertDatabaseMissing('users', ['username' => $request['username']]);
    }

    public function test_register_failed_duplicate()
    {
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'rahasia-' . mt_rand(1, 9999);

        $this->userService->register($request);

        $this->expectException(Validate_exception::class);

        $this->userService->register($request);

        $this->expectExceptionMessage("username / password is blank.");
    }



    public function test_getByUsername_success()
    {
        // create user
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'rahasia-' . mt_rand(1, 9999);

        $this->userService->register($request);

        // getByUsername
        $response = $this->userService->getByUsername($request->username);

        $this->assertEquals($request->username, $response->username);
        $this->assertTrue(Hash::check($request->password, $response->password));
    }


    public function test_getByUsername_failed_blankUsername()
    {
        $this->expectException(Validate_exception::class);

        $this->userService->getByUsername("");

        $this->expectExceptionMessage("username / password is blank.");
    }

    public function test_getByUsername_failed_emptyUsername()
    {
        $this->expectException(Validate_exception::class);

        $this->userService->getByUsername("username ini pasti tidak ada di database");

        $this->expectExceptionMessage("username / password is blank.");
    }



    public function test_login_success()
    {
        // create user
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'rahasia-' . mt_rand(1, 9999);

        $this->userService->register($request);

        $this->userService->login($request);

        $this->assertTrue(session()->has('username'));
    }


    public function test_login_failed_usernameAndPasswordIsWrong()
    {
        $this->expectException(Validate_exception::class);

        $request = new Request();
        $request['username'] = "";
        $request['password'] = "";

        $this->userService->login($request);

        $this->assertTrue(session()->missing('username'));
    }


    public function test_login_failed_usernameIsWrong()
    {
        $this->expectException(Validate_exception::class);

        $request = new Request();
        $request['username'] = "username salah";
        $request['password'] = "";

        $this->userService->login($request);

        $this->assertTrue(session()->missing('username'));
    }


    public function test_login_failed_passwordIsEmpty()
    {
        $this->expectException(Validate_exception::class);

        $request = new Request();
        $request['username'] = "contoh" . mt_rand(1, 99999);
        $request['password'] = "";

        $this->userService->register($request);
        $this->userService->login($request);

        $this->assertTrue(session()->missing('username'));
    }


    public function test_login_failed_passwordIsWrong()
    {
        $this->expectException(Validate_exception::class);

        $request = new Request();
        $request['username'] = "contoh" . mt_rand(1, 99999);
        $request['password'] = "rahasia";

        $this->userService->register($request);

        $request['password'] = "password berubah";
        $this->userService->login($request);

        $this->assertTrue(session()->missing('username'));
    }


    public function test_logout()
    {
        $request = new Request();
        $request['username'] = "contoh" . mt_rand(1, 99999);
        $request['password'] = "rahasia";

        $this->userService->register($request);
        $this->userService->login($request);

        $this->assertTrue(session()->has('username'));
        $this->assertEquals($request->username, session()->get('username'));

        $this->userService->logout();

        $this->assertTrue(session()->missing('username'));
    }
}
