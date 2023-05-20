<?php

namespace Tests\Feature\Repository;

use App\Domains\Category_domain;
use App\Repository\Category_repository;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

use function PHPUnit\Framework\isNull;

class CategoryRepository_Test extends TestCase
{
    protected $userService;
    protected $categoryRepository;

    protected $user;

    function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        $this->userService = $this->app->make(User_service::class);
        $this->categoryRepository = $this->app->make(Category_repository::class);

        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 99999);
        $request['password'] = 'rahasia';

        $this->userService->register($request);

        $this->user = $this->userService->getByUsername($request->username);;
    }

    public function test_create_success()
    {
        $type = ['income', 'spending'];

        $category = new Category_domain($this->user->id);
        $category->code = 'C' . mt_rand(1, 9999999);
        $category->name = 'contoh-' . mt_rand(1, 9999);
        $category->type = $type[mt_rand(0, 1)];

        $this->categoryRepository->create($category);

        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'code' => $category->code,
            'type' => $category->type
        ]);
    }


    public function test_getByCode_success()
    {
        $type = ['income', 'spending'];

        $category = new Category_domain($this->user->id);
        $category->code = 'C' . mt_rand(1, 9999999);
        $category->name = 'contoh-' . mt_rand(1, 9999);
        $category->type = $type[mt_rand(0, 1)];

        $this->categoryRepository->create($category);

        $response = $this->categoryRepository->getByCode($category->code);


        $this->assertEquals($response->name, $category->name);
        $this->assertEquals($response->code, $category->code);
        $this->assertEquals($response->type, $category->type);
    }

    public function test_getByCodeReturnNull()
    {
        $response = $this->categoryRepository->getByCode("ini pasti tidak ada");

        $this->assertNull($response);
    }

    public function test_getbyUserId_success()
    {
        $type = ['income', 'spending'];

        $category = new Category_domain($this->user->id);
        $category->code = 'C' . mt_rand(1, 9999999);
        $category->name = 'contoh-' . mt_rand(1, 9999);
        $category->type = $type[mt_rand(0, 1)];

        $this->categoryRepository->create($category);

        $category->code = 'C' . mt_rand(1, 9999999);
        $category->name = 'contoh-' . mt_rand(1, 9999);
        $this->categoryRepository->create($category);
        $category->type = $type[mt_rand(0, 1)];

        $response = $this->categoryRepository->getByUserId($this->user->id);
        $response = collect($response);

        $getCategory = $response->where('code', $category->code)->first();

        $this->assertTrue($response->count() >= 2);
        $this->assertIsObject($response);
        $this->assertEquals($category->name, $getCategory->name);
    }


    public function test_getByUserIdReturnNull()
    {
        $response = $this->categoryRepository->getByUserId(1023791728732898);

        $this->assertTrue($response->isEmpty());
    }



    public function test_update_success()
    {
        $type = ['income', 'spending'];

        $category = new Category_domain($this->user->id);
        $category->code = 'C' . mt_rand(1, 9999999);
        $category->name = 'contoh-' . mt_rand(1, 9999);
        $category->type = $type[mt_rand(0, 1)];

        $this->categoryRepository->create($category);

        $category->name = 'contoh-' . mt_rand(1, 9999);
        $category->type = $type[mt_rand(0, 1)];

        $this->categoryRepository->update($category);

        $this->assertDatabaseHas('categories', [
            'code' => $category->code,
            'name' => $category->name,
            'type' => $category->type,
        ]);
    }



    public function test_deleteByCode()
    {
        $type = ['income', 'spending'];

        $category = new Category_domain($this->user->id);
        $category->code = 'C' . mt_rand(1, 9999999);
        $category->name = 'contoh-' . mt_rand(1, 9999);
        $category->type = $type[mt_rand(0, 1)];

        $this->categoryRepository->create($category);

        $this->assertDatabaseHas('categories', [
            'code' => $category->code,
            'name' => $category->name
        ]);

        $this->categoryRepository->deleteByCode($category->code);

        $this->assertDatabaseMissing('categories', [
            'code' => $category->code
        ]);
        $this->assertDatabaseMissing('categories', [
            'name' => $category->name
        ]);
    }
}
