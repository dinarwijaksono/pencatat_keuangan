<?php

namespace App\Livewire\Auth;

use App\Services\User_service;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use function PHPUnit\Framework\isTrue;

class LoginForm extends Component
{
    public $email;
    public $password;

    protected $userService;

    public function booted()
    {
        $this->userService = App::make(UserService::class);
    }

    public function doLogin()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $login = $this->userService->login($this->email, $this->password);

            if (!$login) {
                session()->flash('failed', "Email / password salah.");

                $this->password = '';

                return back();
            } else {
                return redirect('/');
            }

            Log::info('do login success', [
                'email' => $this->email,
                'class' => "LoginForm"
            ]);
        } catch (\Throwable $th) {
            Log::error('do login failed', [
                'email' => $this->email,
                'class' => "LoginForm",
                'exeption' => $th->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
