<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function findUserById($id)
    {
        return User::with('invitedUsers', 'inviter')->findOrFail($id);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id); 
        
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data); 

        return $user; 
    }


    public function searchUsers(string $query)
    {
        return User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('id', 'like', "%{$query}%")
            ->get();
    }

  
    public function create(array $userData)
    {
        return User::create($userData);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }


    public function findById($userId)
    {
        return User::findOrFail($userId);
    }

    public function search($query)
    {
        return User::where('id', 'like', "%{$query}%")->get();
    }



  
}
