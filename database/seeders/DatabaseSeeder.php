<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Services\Category_service;
use App\Services\User_service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $user_service = App::make(User_service::class);

        $user_service->createUser('damayanti', 'damayanti@gmail.com', 'damayanti');

        $user = DB::table('users')->select('id')->where('username', 'damayanti')->first();

        $category_service = App::make(Category_service::class);
        $category_service->addCategory($user->id, 'gaji', 'pemasukan');
        $category_service->addCategory($user->id, 'makanan', 'pengeluaran');
    }
}
