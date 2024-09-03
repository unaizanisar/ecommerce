<?php

namespace App\Repositories;
 
use App\Models\User;
use App\Models\Role;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::with('role')->orderBy('id', 'desc')->get();
    }
    public function getAllRoles()
    {
        return Role::where('name', '!=', 'Super Admin')->get();
    }
    public function getUsersbyId($id)
    { 
        return User::findOrFail($id);
    }
    public function createUser(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return User::create($data);
    }
    
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
        }
        return $user;
    }
    public function updateUserStatus($id, $status)
    {
        $user = User::findOrFail($id);
        $user->status = $status;
        $user->save();
        return $user;
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
}
