<?php

namespace App\Http\Livewire\Auth;

use App\Services\User_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class RegisterForm extends Component
{
    public $username;
    public $password;
    public $confirm_password;

    // public $alert = null;

    protected $userService;

    public function booted()
    {
        $this->userService = App::make(User_service::class);
    }

    protected $rules = [
        'username' => 'required|unique:users,username',
        'password' => 'required',
        'confirm_password' => 'required|same:password'
    ];

    public function doRegister()
    {
        $this->validate();

        $request = new Request();
        $request['username'] = $this->username;
        $request['password'] = $this->password;

        $this->userService->register($request);

        return redirect('/Auth/register')->with('registerSuccess', 'Username berhasil di daftarkan.');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
