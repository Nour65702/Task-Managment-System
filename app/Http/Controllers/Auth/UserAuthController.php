<?php

namespace App\Http\Controllers\Auth;

use App\Contract\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUserLoginRequest;
use App\Http\Requests\Auth\StoreUserRegisterRequest;
use App\Services\AuthServices\UserAuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    protected $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function register(StoreUserRegisterRequest $request)
    {
        $userData = $request->validated();
        $response = $this->userAuthService->register($userData);

        return ApiResponse::success($response);
    }

    public function login(StoreUserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $response = $this->userAuthService->login($credentials);

        if (!$response) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ApiResponse::success($response);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $this->userAuthService->logout($user);

        return ApiResponse::success(['message' => 'Logged out successfully']);
    }
}
