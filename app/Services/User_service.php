<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Integer;

class User_service
{

    public function createUser($username, $email, $password): void
    {
        $strRandom = '';

        for ($i = 0; $i < 8; $i++) {
            $array = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];

            $strRandom .= $array[mt_rand(0, 9)];
        }

        DB::table('users')->insert([
            'code' => $strRandom,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000)
        ]);
    }

    public function getUser($key, $value): object
    {
        $key = strtolower($key);
        $value = strtolower($value);

        $user = DB::table('users')
            ->select('username', 'email', 'code')
            ->where($key, $value)
            ->first();

        return collect($user);
    }

    public function getIdWhereCode($code): Integer | bool
    {
        $user = DB::table('users')
            ->select('id')
            ->where('code', $code)
            ->first();

        if (collect($user)->isEmpty()) {
            return false;
        }

        return $user->id;
    }
}
