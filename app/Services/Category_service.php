<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Category_service
{

    public function addCategory($user_id, $name, $type): void
    {
        DB::table('categories')->insert([
            'user_id' => $user_id,
            'name' => strtolower($name),
            'type' => $type == strtolower("pemasukan") ? 1 : 0,
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);
    }


    public function getlistCategory($user_id): array
    {
        $categories = DB::table('categories')
            ->select('name', 'type')
            ->where('user_id', $user_id)
            ->get();

        $listCategory = [];
        foreach ($categories as $category) {
            $listCategory[] = [
                'name' => $category->name,
                'type' => $category->type == 1 ? 'Pemasukan' : 'Pengeluaran'
            ];
        }

        return $listCategory;
    }
}
