<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category_seeder extends Seeder
{
    public function run(): void
    {
        $user = User::select('id')->where('username', 'test')->first();

        $type = ['income', 'spending'];

        Category::create([
            'user_id' => $user->id,
            'code' => 'c' . mt_rand(1, 9999999),
            'name' => 'example-' . mt_rand(1, 99),
            'type' => $type[rand(0, 1)],
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);
    }
}
