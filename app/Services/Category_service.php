<?php

namespace App\Services;

use App\Domains\Category_domain;
use App\Models\Category;
use App\Models\Transaction;
use App\Repository\Category_repository;
use App\Repository\User_repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class Category_service
{
    protected $userRepository;
    protected $categoryRepository;

    function __construct(User_repository $userRepository, Category_repository $categoryRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    // create
    public function addCategory(Category_domain $categoryDomain): void
    {
        try {
            $category = new Category_domain($categoryDomain->userId);
            $category->code = 'C' . mt_rand(1, 9999999);
            $category->name = strtolower($categoryDomain->name);
            $category->type = strtolower($categoryDomain->type);

            // cek code
            $cat = $this->categoryRepository->getByCode($category->code);
            if (!is_null($cat)) {
                throw new \Exception("Code duplicate");
            }

            $this->categoryRepository->create($category);
        } catch (\Exception $th) {
            throw $th;
        }
    }

    // Read
    public function getByCode(string $code): object
    {
        $category = Category::select('user_id', 'id', 'code', 'name', 'type', 'created_at', 'updated_at')
            ->where('code', $code)
            ->first();

        if (is_null($category)) {
            $category = new stdClass();
            $category->user_id = null;
            $category->id = null;
            $category->code = null;
            $category->name = null;
            $category->type = null;
            $category->created_at = null;
            $category->updated_at = null;
        }

        Log::info('get category by code', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username
        ]);

        return $category;
    }


    public function getByNameAndType(string $name, string $type): object
    {
        $category = Category::select('user_id', 'id', 'code', 'name', 'type', 'created_at', 'updated_at')
            ->where('user_id', auth()->user()->id)
            ->where('name', $name)
            ->where('type', $type)
            ->first();

        Log::info('get category by name and type', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username
        ]);

        return $category;
    }


    public function isExist(string $name, string $type): bool
    {
        $category = Category::select('code')
            ->where('user_id', auth()->user()->id)
            ->where('name', $name)
            ->where('type', $type)
            ->get();

        Log::info('category is exist', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username
        ]);

        return !$category->isEmpty();
    }

    public function getAll(): ?object
    {
        $category = Category::select('id', 'code', 'name', 'type', 'created_at', 'updated_at')
            ->where('user_id', auth()->user()->id)
            ->orderBy('name')
            ->get();

        Log::info('get category all', [
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'content' => $category
        ]);

        return $category;
    }



    // Update


    // delete
    public function deleteByCode(string $code): array
    {
        $getCategory = Category::select('id', 'code', 'name')->where('code', $code)->get();
        $category = $getCategory->first();

        if ($getCategory->isEmpty()) {

            $result = [
                'status' => false,
                'message' => "Kategori gagal di hapus."
            ];

            Log::error("delete category failed", [
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                "isue" => "kode is empty",
                "data" => [
                    'code' => $code
                ]
            ]);

            return $result;
        }

        // cek apakah kategori di pakai di transaksi
        $categoryCheck = Transaction::select('id')->where('category_id', $category->id)->get();
        if (!$categoryCheck->isEmpty()) {

            Log::error("delete category failed", [
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                "isue" => "Kategori dipakai pada transaksi",
                "data" => [
                    'code' => $code
                ]
            ]);

            $result = [
                'status' => false,
                'message' => "Kategori $category->name tidak bisa dihapus, karena ada transaksi yang mengunakan kategori ini."
            ];

            return $result;
        }

        DB::table('categories')->where('code', '=', $code)->delete();
        // Category::where('code', $code)->delete();

        Log::info("delete category success", [
            'id' => auth()->user()->id,
            'username' => auth()->user()->username,
        ]);

        $result = [
            'status' => true,
            'message' => "Kategori berhasil di hapus."
        ];

        return $result;
    }
}
