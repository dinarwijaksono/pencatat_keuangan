<?php

namespace App\Services;

use App\Domains\Category_domain;
use App\Repository\Category_repository;
use App\Repository\User_repository;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class Category_service
{
    protected $userRepository;
    protected $categoryRepository;

    function __construct(User_repository $userRepository, Category_repository $categoryRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    // Read
    public function addCategory(Request $request): void
    {
        try {
            $category = new Category_domain($request->userId);
            $category->code = 'C' . mt_rand(1, 9999999);
            $category->name = $request->name;
            $category->type = $request->type;

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
    public function deleteByCode(string $code): void
    {
        try {
            // cek code
            $cat = $this->categoryRepository->getByCode($code);
            if (is_null($cat)) {
                throw new \Exception("Code is empty");
            }

            $this->categoryRepository->deleteByCode($code);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
