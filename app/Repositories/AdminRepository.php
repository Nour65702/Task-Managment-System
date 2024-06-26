<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function createAdmin(array $data)
    {
        return Admin::create($data);
    }

    public function findByEmail($email)
    {
        return Admin::where('email', $email)->first();
    }
}
