<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class User_repository
{
    public function create($username, $password): void
    {
        DB::table('users');
    }
}
