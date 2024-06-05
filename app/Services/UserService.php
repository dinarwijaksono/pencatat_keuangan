<?php

namespace App\Services;

use App\Domains\UserDomain;
use App\Exceptions\Handler;
use App\Exceptions\Validate_exception;
use App\Exceptions\ValidateExeption;
use App\Models\TokenTelegramBot;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\throwException;

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
            $user->start_date = 1;
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
            Log::error('set telegram token failed', [
                'message' => $th->getMessage()
            ]);
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

    public function getTelegramId(int $userId): object | null
    {
        try {
            self::boot();

            $telegramId = TokenTelegramBot::select('chat_id', 'created_at', 'updated_at')
                ->where('user_id', $userId)
                ->first();

            Log::info('get telegram id success');

            return $telegramId;
        } catch (\Throwable $th) {
            Log::error('get telegram id failde', [
                'message' => $th->getMessage()
            ]);
        }
    }


    // update
    public function setStartDate(int $userId, int $startDate): void
    {
        try {
            self::boot();

            if ($startDate > 28 || $startDate < 1) {
                Log::error('set start date failed', [
                    'message' => 'start date not validat'
                ]);

                throw new ValidateExeption("start date not validat", 1);
            }


            User::where('id', $userId)
                ->update([
                    'start_date' => $startDate
                ]);

            Log::info('set start date success');
        } catch (\Throwable $th) {
            Log::error('set start date failed', ['message' => $th->getMessage()]);
        }
    }


    // delete
    public function deleteTelegramToken(int $userId): void
    {
        try {
            self::boot();

            TokenTelegramBot::where('user_id', $userId)->delete();

            Log::info('delete telegram token success');
        } catch (\Throwable $th) {
            Log::error('delete telegram token failed', [
                'message' => $th->getMessage()
            ]);
        }
    }


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
