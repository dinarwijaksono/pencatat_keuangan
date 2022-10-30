<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User_service
{

    public function createUser($username, $email, $password)
    {
        DB::table('users')->insert([
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000)
        ]);
    }
}
