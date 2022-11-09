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


    public function getCategory($id): array
    {
        $category = DB::table('categories')
            ->select('name', 'type', 'user_id')
            ->where('id', $id)
            ->first();

        $category = [
            'name' => $category->name,
            'user_id' => $category->user_id,
            'type' => $category->type == 1 ? 'pemasukan' : 'pengeluaran'
        ];

        return $category;
    }


    public function getlistCategory($user_id): array
    {
        $categories = DB::table('categories')
            ->select('name', 'type', 'user_id', 'id')
            ->where('user_id', $user_id)
            ->get();

        $listCategory = [];
        foreach ($categories as $category) {
            $listCategory[] = [
                'name' => $category->name,
                'type' => $category->type == 1 ? 'pemasukan' : 'pengeluaran',
                'id' => $category->id,
                'user_id' => $category->user_id
            ];
        }

        return $listCategory;
    }


    public function deleteCategory($id): void
    {
        DB::table('categories')
            ->where('id', $id)
            ->delete();
    }
}
