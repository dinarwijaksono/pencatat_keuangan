<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class Category_service
{

    public function addCategory($user_id, $name, $type)
    {
        DB::table('categories')->insert([
            'user_id' => $user_id,
            'name' => strtolower($name),
            'type' => strtolower($type),
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
            'type' => $category->type
        ];

        return $category;
    }


    public function getByNameWithUserid($name, $userId): array
    {
        $category = DB::table('categories')
            ->select('name', 'type', 'user_id')
            ->where('name', $name)
            ->where('user_id', $userId)
            ->first();

        $category = collect($category);
        if ($category->isEmpty()) {
            return [];
        }

        $data = [
            'name' => $category['name'],
            'user_id' => $category['user_id'],
            'type' => $category['type']
        ];

        return $data;
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
                'type' => $category->type,
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
