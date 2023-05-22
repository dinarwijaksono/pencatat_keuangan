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
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        $this->userService = $this->app->make(User_service::class);

        // create user
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'rahasia';
        $this->userService->register($request);

        $this->user = $this->userService->getByUsername($request->username);
    }



    public function test_render()
    {
        // session()->put('username', $this->)

        $this->get('/Auth/login')
            ->assertSeeLivewire('auth.login-form');
    }

    public function test_doLogin_success()
    {
        // create user
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'rahasia';
        $this->userService->register($request);

        $component = Livewire::test(LoginForm::class)
            ->set('username', $request->username)
            ->set('password', $request->password)
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
