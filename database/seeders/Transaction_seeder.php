<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Transaction_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::select('id')->where('username', 'test')->first();

        $category = Category::select('id', 'type')->where('user_id', $user->id)->get();

        $category = $category[mt_rand(0, $category->count() - 1)];


        $time = strtotime(date('m/d/y', time())) * 1000;

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'code' => 'T' . mt_rand(1, 9999999),
            'period' => date('M-Y', $time / 1000),
            'date' => $time,
            'description' => 'explode-' . mt_rand(1, 99),
            'spending' => $category->type == 'spending' ? mt_rand(1, 999) * 1000 : 0,
            'income' => $category->type == 'income' ? mt_rand(1, 999) * 1000 : 0,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);

        $time = mktime(0, 0, 0, 11, mt_rand(1, 10), 2023);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'code' => 'T' . mt_rand(1, 9999999),
            'period' => date('M-Y', $time / 1000),
            'date' => $time,
            'description' => 'explode-' . mt_rand(1, 99),
            'spending' => $category->type == 'spending' ? mt_rand(1, 999) * 1000 : 0,
            'income' => $category->type == 'income' ? mt_rand(1, 999) * 1000 : 0,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);
    }
}
