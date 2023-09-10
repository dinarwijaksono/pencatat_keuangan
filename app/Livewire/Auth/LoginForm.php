<?php

namespace App\Livewire\Auth;

use App\Services\User_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

use function PHPUnit\Framework\isTrue;

class LoginForm extends Component
{
    public $username;
    public $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

    protected $userService;

    public function booted()
    {
        $this->userService = App::make(User_service::class);
    }

    public function doLogin()
    {
        $this->validate();

        $request = new Request();
        $request['username'] = $this->username;
        $request['password'] = $this->password;

        $login = $this->userService->login($request);

        if (!$login) {
            return redirect('/Auth/login')->with('loginFailed', "Username / password salah.");
        } else {
            return redirect('/Home');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
