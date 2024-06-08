<?php

namespace App\Services\AuthServices;

use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminAuthService
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function login(array $credentials)
    {
        $admin = $this->adminRepository->findByEmail($credentials['email']);

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return false;
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        return ['token' => $token, 'admin' => $admin];
    }

    public function logout($admin)
    {
        $admin->currentAccessToken()->delete();

        return true;
    }
}
