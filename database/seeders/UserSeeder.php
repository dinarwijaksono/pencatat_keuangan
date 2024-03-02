<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'email' => 'test@gmail.com',
            'username' => 'test',
            'password' => Hash::make('test'),
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000)
        ]);
    }
}
