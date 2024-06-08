<?php

namespace App\Http\Controllers\Auth;

use App\Contract\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Services\AuthServices\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    protected $adminAuthService;

    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->validated();
        $response = $this->adminAuthService->login($credentials);

        if (!$response) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ApiResponse::success($response);
    }

    public function logout(Request $request)
    {
        $admin = $request->user();
        $this->adminAuthService->logout($admin);

        return ApiResponse::success(['message' => 'Successfully logged out']);
    }
}
