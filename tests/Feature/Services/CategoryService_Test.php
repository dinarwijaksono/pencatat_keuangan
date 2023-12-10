<?php

namespace Tests\Feature\Services;

use App\Domains\Category_domain;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Category_service;
use App\Services\User_service;
use Database\Seeders\Category_seeder;
use Database\Seeders\Transaction_seeder;
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

        $this->user = User::select('*')->where('username', 'test')->first();

        $this->actingAs($this->user);

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


    public function test_getByCode_success()
    {
        $this->seed(Category_seeder::class);

        $category = Category::select('code', 'name')->first();

        $response = $this->categoryService->getByCode($category->code);

        $this->assertIsObject($response);
        $this->assertEquals($response->name, $category->name);
        $this->assertEquals($response->code, $category->code);
    }


    public function test_getByCode_codeIsEmpty()
    {
        $response = $this->categoryService->getByCode('ini pasti tidak ada');

        $this->assertIsObject($response);
        $this->assertEquals($response->name, null);
    }

    public function test_getByNameAndType_success()
    {
        $this->seed(Category_seeder::class);

        $category = Category::select('user_id', 'name', 'type')->first();

        $response = $this->categoryService->getByNameAndType($category->name, $category->type);

        $this->assertIsObject($response);
        $this->assertEquals($response->name, $category->name);
        $this->assertEquals($response->type, $category->type);
    }


    public function test_isEmpty_true()
    {
        $this->seed(Category_seeder::class);

        $category = Category::select('name', 'type')->first();

        $response = $this->categoryService->isExist($category->name, $category->type);

        $this->assertIsBool($response);
        $this->assertTrue($response);
    }


    public function test_isEmpty_false()
    {
        $response = $this->categoryService->isExist('category empty', 'income');

        $this->assertIsBool($response);
        $this->assertFalse($response);
    }


    public function test_getAll()
    {
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);
        $this->seed(Category_seeder::class);

        $response = $this->categoryService->getAll();

        $this->assertIsObject($response);
        $this->assertTrue($response->count() >= 2);
    }


    public function test_deleteBycode_success()
    {
        $this->seed(Category_seeder::class);

        $category = DB::table('categories')->select('code', 'name', 'type')->first();

        $response = $this->categoryService->deleteByCode($category->code);

        $this->assertDatabaseMissing('categories', [
            'code' => $category->code,
            'name' => $category->name,
            'type' => $category->type
        ]);

        $this->assertIsArray($response);
        $this->assertTrue($response['status']);
        $this->assertEquals($response['message'], "Kategori berhasil di hapus.");
    }


    public function test_deleteByCode_failed_codeIsEmpty()
    {
        $code = 'C1';

        $response = $this->categoryService->deleteByCode($code);

        $this->assertIsArray($response);
        $this->assertFalse($response['status']);
    }


    public function test_deleteByCode_failed_codeIsExistInTransaction()
    {
        $this->seed(Category_seeder::class);
        $this->seed(Transaction_seeder::class);

        $transaction = Transaction::select('category_id')->where('user_id', $this->user->id)->first();
        $category = Category::select('code')->where('id', $transaction->category_id)->first();

        $response = $this->categoryService->deleteByCode($category->code);

        $this->assertIsArray($response);
        $this->assertFalse($response['status']);
    }
}
