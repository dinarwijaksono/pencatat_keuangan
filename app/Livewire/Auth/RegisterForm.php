<?php

namespace App\Livewire\Auth;

use App\Domains\UserDomain;
use App\Services\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RegisterForm extends Component
{
    public $email;
    public $username;
    public $password;
    public $confirmPassword;

    protected $userService;

    public function booted()
    {
        $this->userService = App::make(UserService::class);
    }

    public function doRegister()
    {
        $this->validate([
            'email' => 'required|unique:users,email',
            'username' => 'required|min:4',
            'password' => 'required|min:4',
            'confirmPassword' => 'required|same:password'
        ]);

        try {
            $userDomain = new UserDomain();
            $userDomain->email = $this->email;
            $userDomain->username = $this->username;
            $userDomain->password = $this->password;

            $this->userService->register($userDomain);

            session()->flash('success', 'Akun berhasil di daftarkan.');

            Log::info('doRegister success', [
                'email' => $this->email,
                'username' => $this->username,
                'class' => 'RegisterForm'
            ]);

            $this->redirect('/Auth/register');
        } catch (\Throwable $th) {
            Log::error('doRegister failed', [
                'email' => $this->email,
                'username' => $this->username,
                'class' => 'RegisterForm',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
