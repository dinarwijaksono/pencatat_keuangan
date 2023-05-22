<?php

namespace Tests\Feature\Services;

use App\Services\Category_service;
use App\Services\User_service;
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

        config(['database.default' => 'mysql-test']);

        $userService = $this->app->make(User_service::class);
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 99999);
        $request['password'] = 'rahasia';
        $userService->register($request);
        $this->user = $userService->getbyUsername($request->username);

        $this->categoryService = $this->app->make(Category_service::class);
    }


    public function test_addCategory_success()
    {
        $type = ['income', 'spending'];

        $request = new Request();
        $request['name'] = 'contoh-' . mt_rand(1, 9999);
        $request['type'] = $type[mt_rand(0, 1)];

        $this->categoryService->addCategory($request, $this->user->username);

        $this->assertDatabaseHas('categories', [
            'name' => $request->name,
            'type' => $request->type,
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

        $this->categoryService->addCategory($request, $this->user->username);
        $this->categoryService->addCategory($request, $this->user->username);

        $response = $this->categoryService->getByUsername($this->user->username);

        $this->assertTrue($response->count() >= 2);
        $this->assertIsObject($response);
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
        $type = ['income', 'spending'];

        $request = new Request();
        $request['name'] = 'contoh-' . mt_rand(1, 9999);
        $request['type'] = $type[mt_rand(0, 1)];
        $this->categoryService->addCategory($request, $this->user->username);

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
