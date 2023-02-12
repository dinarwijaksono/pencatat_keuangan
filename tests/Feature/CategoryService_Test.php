<?php

namespace Tests\Feature;

use App\Services\Category_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryService_Test extends TestCase
{
    private $category_service;

    public function setUp(): void
    {
        parent::setUp();

        $this->category_service = $this->app->make(Category_service::class);

        DB::table('categories')->delete();
    }


    public function test_addCategorySuccess()
    {
        $name = 'gajiasdf';
        $type = 'pemasukan';

        $this->category_service->addCategory(1, $name, $type);

        $response = $this->category_service->getByNameWithUserid($name, 1);

        $this->assertDatabaseHas('categories', ['name' => $name]);

        $this->assertEquals($response['name'], $name);
        $this->assertEquals($response['type'], $type);
    }

    public function test_getByNameWithUseridSuccess()
    {
        $name = 'gajihd';

        DB::table('categories')->insert([
            'name' => $name,
            'user_id' => 1,
            'type' => 'pemasukan',
            'created_at' => round(microtime(true) * 1000),
            'updated_at' => round(microtime(true) * 1000),
        ]);

        $response = $this->category_service->getByNameWithUserid($name, 1);

        $this->assertTrue(!empty($response));
        $this->assertDatabaseHas('categories', ['name' => $name]);
    }


    public function test_getByNameWithUseridFailed()
    {
        $response = $this->category_service->getByNameWithUserid('tidak ada', 1);

        $this->assertTrue(empty($response));
        $this->assertDatabaseMissing('categories', ['name' => 'tidak ada']);
    }
}
