<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use stdClass;

class CategoryService
{
    public function boot(): void
    {
        Log::withContext(['class' => CategoryService::class]);
    }

    // read
    public function getByCode(string $code): object
    {
        try {

            $category = Category::select(
                'user_id',
                'id',
                'code',
                'name',
                'type',
                'created_at',
                'updated_at'
            )
                ->where('code', $code)
                ->first();

            Log::info('get category by code success');

            return $category;
        } catch (\Throwable $th) {
            Log::error('get category by code failed', [
                'message' => $th->getMessage()
            ]);

            return new stdClass();
        }
    }
}
