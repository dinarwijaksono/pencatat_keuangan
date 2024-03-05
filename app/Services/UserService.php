<?php

namespace App\Services;

use App\Domains\UserDomain;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{

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
}
