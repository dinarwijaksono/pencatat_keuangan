<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Category_service
{

    public function addCategory($user_id, $name, $type)
    {
        DB::table('categories')->insert([
            'user_id' => $user_id,
            'name' => strtolower($name),
            'type' => $type == strtolower("pemasukan") ? 1 : 0,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);
    }
}
