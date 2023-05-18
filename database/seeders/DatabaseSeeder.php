<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Transaction_domain;
use App\Services\Category_service;
use App\Services\Transaction_service;
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


        // $user_service = App::make(User_service::class);

        // $user_service->createUser('damayanti', 'damayanti@gmail.com', 'damayanti');

        // $user = DB::table('users')->select('id')->where('username', 'damayanti')->first();

        // $category_service = App::make(Category_service::class);
        // $category_service->addCategory($user->id, 'Bonus', 'income');
        // $category_service->addCategory($user->id, 'Makanan', 'spending');
        // $category_service->addCategory($user->id, 'Tagihan', 'spending');

        // for ($i = 0; $i < 500; $i++) :

        //     $date = mktime(0, 0, 0, mt_rand(1, 3), mt_rand(1, 28), 2023);

        //     $category = $category_service->getByIdWithUserId(mt_rand(1, 3), 1);
        //     $array = "damayanti puput pipit dara dinda may";
        //     $array = explode(" ", $array);

        //     $transaciton_domain = App::make(Transaction_domain::class);
        //     $transaciton_domain->user_id = 1;
        //     $transaciton_domain->title = $array[mt_rand(0, 5)];
        //     $transaciton_domain->category_id = $category['id'];
        //     $transaciton_domain->period = date('F-Y', $date);
        //     $transaciton_domain->date = $date;
        //     $transaciton_domain->type = $category['type'];
        //     $transaciton_domain->value = mt_rand(1, 50) * 5000;

        //     $transaction_service = App::make(Transaction_service::class);
        //     $transaction_service->addTransaction($transaciton_domain);
        // endfor;
    }
}
