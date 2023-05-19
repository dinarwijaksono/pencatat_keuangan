<?php

namespace Tests\Feature\Livewire\Auth;

use App\Http\Livewire\Auth\RegisterForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterFormTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);
    }

    public function test_render()
    {
        $this->get('/Auth/register')
            ->assertSeeLivewire('auth.register-form');
    }

    public function test_doRegister_success()
    {
        $username = 'contoh-livewire-' . mt_rand(1, 9999);
        $password = 'rahasia';
        $confirm_password = 'rahasia';

        $livewire = Livewire::test(RegisterForm::class)
            ->set('username', $username)
            ->set('password', $password)
            ->set('confirm_password', $confirm_password)
            ->call('doRegister');

        $this->assertDatabaseHas('users', ['username' => $username]);
        $livewire->assertRedirect('/Auth/register');
    }


    public function test_inputIsrequired()
    {
        $livewire = Livewire::test(RegisterForm::class)
            ->set('username', '')
            ->set('password', '')
            ->set('confirm_password', '')
            ->call('doRegister');

        $livewire->assertHasErrors([
            'username' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
    }


    public function test_usernameIsUnique()
    {
        $username = 'contoh-livewire-' . mt_rand(1, 9999);
        $password = 'rahasia';
        $confirm_password = 'rahasia';

        Livewire::test(RegisterForm::class)
            ->set('username', $username)
            ->set('password', $password)
            ->set('confirm_password', $confirm_password)
            ->call('doRegister');

        $livewire = Livewire::test(RegisterForm::class)
            ->set('username', $username)
            ->set('password', $password)
            ->set('confirm_password', $confirm_password)
            ->call('doRegister');

        $livewire->assertHasErrors(['username' => 'unique']);
    }

    public function test_confirmPasswordIsSame()
    {
        $username = 'contoh-livewire-' . mt_rand(1, 9999);
        $password = 'rahasia';
        $confirm_password = 'rahasia1234';

        $livewire = Livewire::test(RegisterForm::class)
            ->set('username', $username)
            ->set('password', $password)
            ->set('confirm_password', $confirm_password)
            ->call('doRegister');

        $livewire->assertHasErrors(['confirm_password' => 'same']);
    }
}
