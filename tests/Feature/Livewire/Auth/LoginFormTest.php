<?php

namespace Tests\Feature\Livewire\Auth;

use App\Livewire\Auth\LoginForm;
use App\Services\User_service;
use Database\Seeders\User_seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Tests\TestCase;

class LoginFormTest extends TestCase
{
    public function test_render()
    {
        $this->get('/Auth/login')
            ->assertSeeLivewire('auth.login-form');
    }

    public function test_doLogin_success()
    {
        $this->seed([User_seeder::class]);

        $component = Livewire::test(LoginForm::class)
            ->set('email', env("USER_EMAIL_TEST"))
            ->set('password', 'rahasia')
            ->call('doLogin');

        $component->assertRedirect('/');
        $this->assertNotEmpty(auth()->user());
        $this->assertEquals('test@gmail.com', auth()->user()->email);
        $this->assertEquals('test', auth()->user()->username);
    }

    public function test_doLogin_failed_email_is_wrong()
    {
        $this->seed([User_seeder::class]);

        $response = Livewire::test(LoginForm::class)
            ->set('email', 'test@gmail.com123')
            ->set('password', 'rahasia')
            ->call('doLogin');

        $this->assertTrue(empty(auth()->user()));
        $response->assertSee('Email / password salah.');
    }

    public function test_inputIsRequired()
    {
        $component = Livewire::test(LoginForm::class)
            ->set('email', '')
            ->set('password', '')
            ->call('doLogin');

        $component->assertHasErrors([
            'email' => 'required',
            'password' => 'required',
        ]);

        $this->assertEmpty(auth()->user());
    }
}
