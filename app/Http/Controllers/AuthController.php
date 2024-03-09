<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function doLogout(): RedirectResponse
    {
        try {
            Log::info('do logout success', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->email,
                'class' => AuthController::class
            ]);

            $this->userService->logout();

            return redirect('/Auth/login');
        } catch (\Throwable $th) {
            Log::error('do logout failed', [
                'user_id' => auth()->user()->id,
                'email' => auth()->user()->email,
                'class' => AuthController::class,
                'exeption' => $th->getMessage()
            ]);

            return redirect('/');
        }
    }
}
