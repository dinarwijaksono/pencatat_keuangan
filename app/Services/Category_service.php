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
    public function isExists(int $userId, string $name, string $type): bool
    {
        $category = DB::table('categories')
            ->select('name')
            ->where('user_id', $userId)
            ->where('name', $name)
            ->where('type', $type)
            ->first();

        $category = collect($category);
        return $category->isNotEmpty();
    }

    public function getByCode(string $code): ?object
    {
        return $this->categoryRepository->getByCode($code);
    }

    public function getByUsername(string $username): ?object
    {
        $user = $this->userRepository->getByUsername($username);

        return $this->categoryRepository->getByUserId($user->id);
    }



    // Update
    public function edit(Request $request, string $username): void
    {
        try {
            $user = $this->userRepository->getByUsername($username);

            $category = new Category_domain($user->id);
            $category->code = $request->code;
            $category->name = $request->name;
            $category->type = $request->type;

            // cek duplicate dari code
            $cat = $this->categoryRepository->getByCode($category->code);
            if (is_null($cat)) {
                throw new \Exception("Code is empty");
            }

            $this->categoryRepository->update($category);
        } catch (\Exception $th) {
            throw $th;
        }
    }


    // delete
    public function deleteByCode(string $code): Object
    {
        $getCategory = Category::select('id', 'code', 'name')->where('code', $code)->get();
        $category = $getCategory->first();

        if ($getCategory->isEmpty()) {

            $result = collect([
                'status' => false,
                'message' => "Kategori gagal di hapus."
            ]);

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

            $result = collect([
                'status' => false,
                'message' => "Kategori $category->name tidak bisa dihapus, karena ada transaksi yang mengunakan kategori ini."
            ]);

            return $result;
        }

        Category::where('code', $code)->delete();

        Log::info("delete category success", [
            'id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'data' => [
                'category_code' => $category->code,
                'category_name' => $category->name
            ]
        ]);

        $result = collect([
            'status' => true,
            'message' => "Kategori berhasil dihapus."
        ]);

        return $result;
    }
}
