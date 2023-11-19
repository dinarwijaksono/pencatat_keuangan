<?php

namespace Tests\Feature\Services;

use App\Domains\Category_domain;
use App\Services\Category_service;
use App\Services\User_service;
use Database\Seeders\Category_seeder;
use Database\Seeders\User_seeder;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\isNull;

class CategoryService_Test extends TestCase
{
    protected $user;
    protected $categoryService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(User_seeder::class);

        $userService = $this->app->make(User_service::class);

        $this->user = $userService->getbyUsername('test');

        $this->categoryService = $this->app->make(Category_service::class);
    }


    public function test_addCategory_success()
    {
        $type = ['income', 'spending'];

        $categoryDomain = new Category_domain($this->user->id);
        $categoryDomain->name = 'example-1';
        $categoryDomain->type = $type[mt_rand(0, 1)];

        $this->categoryService->addCategory($categoryDomain);

        $this->assertDatabaseHas('categories', [
            'name' => $categoryDomain->name,
            'type' => $categoryDomain->type,
        ]);
    }


    // public function test_addCategory_failed_codeDuplicate()
    // {
    //     $type = ['income', 'spending'];

    //     $request = new Request();
    //     $request['userId'] = $this->user->id;
    //     $request['name'] = 'contoh-' . mt_rand(1, 9999);
    //     $request['type'] = $type[mt_rand(0, 1)];

    //     $this->categoryService->addCategory($request);

    //     $this->expectException(Exception::class);

    //     $this->categoryService->addCategory($request);
    // }


    public function test_isExists_false()
    {
        $response = $this->categoryService->isExists(10, 'kategori ini pasti tidak ada', 'spending');

        $this->assertFalse($response);
    }


    public function test_isExists_true()
    {
        $type = ['income', 'spending'];

        $request = new Request();
        $request['name'] = 'contoh-' . mt_rand(1, 9999);
        $request['type'] = $type[mt_rand(0, 1)];

        $this->categoryService->addCategory($request, $this->user->username, $type);

        $response = $this->categoryService->isExists($this->user->id, $request->name, $request->type);

        $this->assertTrue($response);
    }


    public function test_getByCode_success()
    {
        $type = ['income', 'spending'];

        $request = new Request();
        $request['name'] = 'contoh-' . mt_rand(1, 9999);
        $request['type'] = $type[mt_rand(0, 1)];

        $this->categoryService->addCategory($request, $this->user->username);

        $category = DB::table('categories')->select('code')->first();

        $response = $this->categoryService->getByCode($category->code);

        $this->assertTrue(!is_null($response));
        $this->assertIsObject($response);
        $this->assertTrue(!is_null($response->name));
    }


    public function test_getByCode_failed_codeIsNull()
    {
        $response = $this->categoryService->getByCode('ini pasti tidak ada');

        $this->assertTrue(is_null($response));
        $this->assertIsNotObject($response);
    }


    public function test_getByUsername()
    {
        $type = ['income', 'spending'];

        $request = new Request();
        $request['name'] = 'contoh-' . mt_rand(1, 9999);
        $request['type'] = $type[mt_rand(0, 1)];

        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);

        $response = $this->categoryService->getByUsername('test');

        $this->assertIsObject($response);
        $this->assertTrue($response->count() >= 2);
    }


    public function test_edit_success()
    {
        $type = ['income', 'spending'];

        $request = new Request();
        $request['name'] = 'contoh-' . mt_rand(1, 9999);
        $request['type'] = $type[mt_rand(0, 1)];
        $this->categoryService->addCategory($request, $this->user->username);

        $category = DB::table('categories')->select('code', 'name', 'type')->first();
        $request['name'] = 'contoh-' . mt_rand(1, 99999);
        $request['type'] = $type[mt_rand(0, 1)];
        $request['code'] = $category->code;

        $this->categoryService->edit($request, $this->user->username);

        $this->assertDatabaseHas('categories', [
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
        ]);
    }


    public function test_deleteBycode_success()
    {
        $this->seed(Category_seeder::class);

        $category = DB::table('categories')->select('code', 'name', 'type')->first();

        $this->categoryService->deleteByCode($category->code);

        $this->assertDatabaseMissing('categories', [
            'code' => $category->code,
            'name' => $category->name,
            'type' => $category->type
        ]);
    }


    public function test_deleteByCode_failed_codeIsEmpty()
    {
        $this->expectException(Exception::class);

        $this->categoryService->deleteByCode('kode ini pasti tidak ada');
    }
}
