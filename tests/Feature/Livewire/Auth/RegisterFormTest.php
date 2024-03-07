<?php

namespace Tests\Feature\Livewire\Auth;

use App\Livewire\Auth\RegisterForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterFormTest extends TestCase
{
    public function test_render()
    {
        $this->get('/Auth/register')
            ->assertSeeLivewire('auth.register-form');
    }

    public function test_doRegister_success()
    {
        $email = 'test@gmail.com';
        $username = 'test';
        $password = env('USER_PASSWORD_TEST');
        $confirmPassword = env('USER_PASSWORD_TEST');

        $livewire = Livewire::test(RegisterForm::class)
            ->set('email', $email)
            ->set('username', $username)
            ->set('password', $password)
            ->set('confirmPassword', $confirmPassword)
            ->call('doRegister');

        $this->assertDatabaseHas('users', ['email' => $email, 'username' => $username]);
        $livewire->assertRedirect('/Auth/register');
    }


    public function test_input_is_required()
    {
        $livewire = Livewire::test(RegisterForm::class)
            ->set('email', '')
            ->set('username', '')
            ->set('password', '')
            ->set('confirmPassword', '')
            ->call('doRegister');

        $livewire->assertSee('The email field is required.');
        $livewire->assertSee('The username field is required.');
        $livewire->assertSee('The password field is required.');

        $livewire->assertHasErrors([
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required'
        ]);
    }


    public function test_email_is_Unique()
    {
        $email = 'test@gmail.com';
        $username = 'contoh-livewire-' . mt_rand(1, 9999);
        $password = env('USER_PASSWORD_TEST');
        $confirmPassword = env('USER_PASSWORD_TEST');

        Livewire::test(RegisterForm::class)
            ->set('email', $email)
            ->set('username', $username)
            ->set('password', $password)
            ->set('confirmPassword', $confirmPassword)
            ->call('doRegister');

        $livewire = Livewire::test(RegisterForm::class)
            ->set('email', $email)
            ->set('email', $email)
            ->set('password', $password)
            ->set('confirmPassword', $confirmPassword)
            ->call('doRegister');

        $livewire->assertHasErrors(['email' => 'unique']);
        $livewire->assertSee('The email has already been taken.');
    }

    public function test_confirm_password_is_not_same()
    {
        $username = 'contoh-livewire-' . mt_rand(1, 9999);
        $password = env('USER_PASSWORD_TEST');
        $confirmPassword = env('USER_PASSWORD_TEST') . '1234';

        $livewire = Livewire::test(RegisterForm::class)
            ->set('username', $username)
            ->set('password', $password)
            ->set('confirmPassword', $confirmPassword)
            ->call('doRegister');

        $livewire->assertHasErrors(['confirmPassword' => 'same']);
        $livewire->assertSee('The confirm password and password must match.');
    }
}
