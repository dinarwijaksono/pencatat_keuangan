<?php

namespace App\Livewire\Auth;

use App\Domains\User_domain;
use App\Services\User_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class RegisterForm extends Component
{
    public $email;
    public $username;
    public $password;
    public $confirm_password;

    protected $userService;

    public function booted()
    {
        $this->userService = App::make(User_service::class);
    }

    public function doRegister()
    {
        $this->validate([
            'email' => 'required|unique:users,email',
            'username' => 'required|min:4',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $userDomain = new User_domain();
        $userDomain->email = $this->email;
        $userDomain->username = $this->username;
        $userDomain->password = $this->password;

        $this->userService->register($userDomain);

        // return redirect('/Auth/register')->with('registerSuccess', 'Akun berhasil di daftarkan.');

        session()->flash('success', 'Akun berhasil di daftarkan.');

        $this->redirect('/Auth/register');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
