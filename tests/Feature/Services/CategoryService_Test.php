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
        $type = ['income', 'spending'];

        $request = new Category_domain(auth()->user()->id);
        $request->name = 'contoh-' . mt_rand(1, 9999);
        $request->type = $type[mt_rand(0, 1)];

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

        $this->assertIsObject($response);
        $this->assertTrue($response['status']);
    }


    public function test_deleteByCode_failed_codeIsEmpty()
    {
        $code = 'C1';

        $response = $this->categoryService->deleteByCode($code);

        $this->assertIsObject($response);
        $this->assertFalse($response['status']);
    }


    public function test_deleteByCode_failed_codeIsExistInTransaction()
    {
        $this->seed(Category_seeder::class);
        $this->seed(Transaction_seeder::class);

        $transaction = Transaction::select('category_id')->where('user_id', $this->user->id)->first();
        $category = Category::select('code')->where('id', $transaction->category_id)->first();

        $response = $this->categoryService->deleteByCode($category->code);

        $this->assertIsObject($response);
        $this->assertFalse($response['status']);
    }
}
