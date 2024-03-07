<?php

namespace App\Services;

use App\Domains\User_domain;
use App\Exceptions\Validate_exception;
use App\Models\User;
use App\Repository\User_repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Integer;

class User_service
{
    protected $userRepository;

    function __construct(User_repository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    // public function register(User_domain $userDomain): void

    public function getByUsername(string $username): ?object
    {
        return $this->userRepository->getByUsername($username);
    }


    // public function login(string $email, string $password): 


    public function logout(): void
    {
        session()->forget('username');
    }




    public function validateRequest(Request $request): void
    {
        if (trim($request->username) == '' || $request->username == null) {
            throw new Validate_exception("username / password is blank.");
        }

        if (trim($request->password) == '' || $request->password == null) {
            throw new Validate_exception("username / password is blank.");
        }
    }

    public function validateUsernameIsWrong(string $username)
    {
        if (trim($username) == '' || $username == null) {
            throw new Validate_exception("username / password is blank.");
        }
    }

    public function validateUsernameIsNotEmpty(string $username): void
    {
        $user = $this->userRepository->getByUsername($username);
        $user = collect($user);
        if ($user->isNotEmpty()) {
            throw new Validate_exception("username / password is blank.");
        }
    }
}
