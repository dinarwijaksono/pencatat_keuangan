<?php

namespace App\Repository;

use App\Domains\Category_domain;
use Illuminate\Support\Facades\DB;

class Category_repository
{
    public function create(Category_domain $category): void
    {
        DB::table('categories')
            ->insert([
                'user_id' => $category->userId,
                'code' => $category->code,
                'name' => $category->name,
                'type' => $category->type,
                'created_at' => round(microtime(true) * 1000),
                'updated_at' => round(microtime(true) * 1000),
            ]);
    }

    public function getByCode(string $code): ?object
    {
        return DB::table('categories')
            ->where('code', $code)
            ->select('id', 'user_id', 'code', 'name', 'type', 'created_at', 'updated_at')
            ->first();
    }


    public function getByUserId(int $userId): ?object
    {
        return DB::table('categories')
            ->where('user_id', $userId)
            ->select('id', 'user_id', 'code', 'name', 'type', 'created_at', 'updated_at')
            ->get();
    }


    public function update(Category_domain $category): void
    {
        DB::table('categories')
            ->update([
                'name' => $category->name,
                'type' => $category->type,
                'updated_at' => round(microtime(true) * 1000),
            ]);
    }


    public function deleteByCode(string $code): void
    {
        DB::table('categories')
            ->where('code', $code)
            ->delete();
    }
}
