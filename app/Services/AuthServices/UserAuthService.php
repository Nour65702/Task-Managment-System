<?php

namespace App\Services\AuthServices;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        $user = $this->userRepository->create($userData);
        $token = $user->createToken('user-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function login(array $credentials)
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        $token = $user->createToken('user-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();

        return true;
    }
}
