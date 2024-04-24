<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use stdClass;

class UserRepository
{
    public function boot(): void
    {
        Log::withContext([
            'class' => UserRepository::class
        ]);
    }

    // read
    public function getById(int $id): object
    {
        try {
            $user = User::select('id', 'email', 'username', 'created_at', 'updated_at')
                ->where('id', $id)
                ->first();

            Log::info('get by id success');

            return $user;
        } catch (\Throwable $th) {
            Log::error('get by id error', [
                'message' => $th->getMessage()
            ]);

            return new stdClass;
        }
    }
}
