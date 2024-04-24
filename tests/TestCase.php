<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        DB::delete("delete from users");
        DB::delete("delete from user_pins");
        DB::delete("delete from categories");
        DB::delete("delete from transactions");
        DB::delete("delete from transaction_histories");
        DB::delete("delete from token_telegram_bots");
    }
}
