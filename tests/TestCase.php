<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        DB::delete("delete from users");
        DB::delete("delete from categories");
        DB::delete("delete from transactions");
    }
}
