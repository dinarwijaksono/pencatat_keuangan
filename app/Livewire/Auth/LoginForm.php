<?php

namespace App\Livewire\Auth;

use App\Services\User_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Component;

use function PHPUnit\Framework\isTrue;

class LoginForm extends Component
{
    public $email;
    public $password;

    protected $userService;

    public function booted()
    {
        $this->userService = App::make(User_service::class);
    }

    public function doLogin()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = $this->userService->login($this->email, $this->password);

        if (!$login) {
            session()->flash('failed', "Email / password salah.");

            $this->password = '';

            return back();
        } else {
            return redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
