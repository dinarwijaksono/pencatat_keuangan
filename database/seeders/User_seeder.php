<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class User_seeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'test@gmail.com',
            'username' => 'test',
            'password' => Hash::make('rahasia'),
            'created_at' => 1,
            'updated_at' => 1
        ]);

        User::create([
            'email' => 'example@gmail.com',
            'username' => 'example',
            'password' => Hash::make('rahasia'),
            'created_at' => 1,
            'updated_at' => 1
        ]);
    }
}
