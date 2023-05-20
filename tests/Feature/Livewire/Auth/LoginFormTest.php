<?php

namespace Tests\Feature\Livewire\Auth;

use App\Http\Livewire\Auth\LoginForm;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Tests\TestCase;

class LoginFormTest extends TestCase
{
    protected $userService;

    public function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        $this->userService = $this->app->make(User_service::class);
    }



    public function test_render()
    {
        $this->get('/Auth/login')
            ->assertSeeLivewire('auth.login-form');
    }

    public function test_doLogin_success()
    {
        $username = 'contoh-' . mt_rand(1, 9999);
        $password = 'rahasia';

        // create user
        $request = new Request();
        $request['username'] = $username;
        $request['password'] = $password;
        $this->userService->register($request);

        $component = Livewire::test(LoginForm::class)
            ->set('username', $username)
            ->set('password', $password)
            ->call('doLogin');

        $component->assertRedirect('/Home');
        $this->assertTrue(session()->has('username'));
    }


    public function test_inputIsRequired()
    {
        $component = Livewire::test(LoginForm::class)
            ->set('username', '')
            ->set('password', '')
            ->call('doLogin');

        $component->assertHasErrors([
            'username' => 'required',
            'password' => 'required',
        ]);

        $this->assertTrue(session()->missing('username'));
    }
}
