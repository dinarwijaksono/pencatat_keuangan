<?php

namespace App\Services;

use App\Domains\UserDomain;
use App\Models\TokenTelegramBot;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function boot(): void
    {
        Log::withContext(['class' => UserService::class]);
    }

    // create
    public function register(UserDomain $userDomain): void
    {
        try {
            $user = new User();
            $user->email = $userDomain->email;
            $user->username = $userDomain->username;
            $user->password = Hash::make($userDomain->password);
            $user->created_at = round(microtime(true) * 1000);
            $user->updated_at = round(microtime(true) * 1000);
            $user->save();

            Log::info('register success', [
                'email' => $userDomain->email,
                'username' => $userDomain->username,
                'class' => "UserService"
            ]);
        } catch (\Throwable $th) {

            Log::error('register failed', [
                'email' => $userDomain->email,
                'username' => $userDomain->username,
                'class' => "UserService",
                'exeption' => $th->getMessage(),
            ]);
        }
    }

    public function setTelegramToken(int $userId, int $token): void
    {
        try {
            self::boot();

            TokenTelegramBot::insert([
                'user_id' => $userId,
                'chat_id' => $token,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);

            Log::info('set telegram token success');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // read
    public function login(string $email, string $password): bool
    {
        try {

            $result = Auth::attempt(['email' => $email, 'password' => $password]);

            if ($result) {
                session()->regenerate();
            }

            Log::info('login success', [
                'email' => $email,
                'class' => "UserService"
            ]);

            return $result;
        } catch (\Throwable $th) {
            Log::error('login failed', [
                'email' => $email,
                'class' => "UserService",
                'exeption' => $th->getMessage()
            ]);
        }
    }

    // delete
    public function logout(): void
    {
        try {
            Log::info('logout success', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->email,
            ]);

            Auth::logout();

            session()->invalidate();

            session()->regenerateToken();
        } catch (\Throwable $th) {
            Log::error('logout failed', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->email,
                'class' => UserService::class,
                'exeption' => $th->getMessage()
            ]);
        }
    }
}
