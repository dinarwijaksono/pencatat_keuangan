<?php

namespace App\Services;

use App\Exceptions\Validate_exception;
use App\Repository\User_repository;
use Illuminate\Http\Request;
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


    public function register(Request $request): void
    {
        try {

            $this->validateRequest($request);

            $this->validateUsernameIsNotEmpty($request->username);

            $this->userRepository->create($request->username, $request->password);
        } catch (Validate_exception $exception) {
            throw $exception;
        }
    }

    public function getByUsername(string $username): object
    {
        try {
            $this->validateUsernameIsWrong($username);
            $this->validateUsernameIsEmpty($username);

            return $this->userRepository->getByUsername($username);
        } catch (Validate_exception $exception) {
            throw $exception;
        }
    }


    public function login(Request $request): void
    {
        try {
            $this->validateRequest($request);
            $this->validateUsernameIsEmpty($request->username);

            $user = $this->userRepository->getByUsername($request->username);

            $this->validatePasswordIsWrong($request->password, $user->password);

            session()->put('username', $user->username);
        } catch (Validate_exception $exception) {
            throw $exception;
        }
    }


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

    public function validateUsernameIsEmpty(string $username): void
    {
        $user = $this->userRepository->getByUsername($username);
        $user = collect($user);
        if ($user->isEmpty()) {
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


    public function validatePasswordIsWrong(string $password, string $passwordHash)
    {
        if (!Hash::check($password, $passwordHash)) {
            throw new Validate_exception("username / password is blank.");
        }
    }
}
