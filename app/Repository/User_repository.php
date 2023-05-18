<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User_repository
{
    // create
    public function create(string $username, string $password): void
    {
        DB::table('users')
            ->insert([
                'username' => $username,
                'password' => Hash::make($password),
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);
    }


    // read
    public function getByUsername(string $username): ?object
    {
        return DB::table('users')
            ->select('id', 'username', 'password', 'created_at', 'updated_at')
            ->where('username', $username)
            ->first();
    }
}
