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
        $user = new User();
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        if (isset($data['profile_photo'])) {
            $user->profile_photo = $data['profile_photo'];
        }
        $user->role_id = $data['role_id'];
        $user->save();
        return $user;
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
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        if (isset($data['password'])) {
            $user->password = $data['password'];
        }
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        if (isset($data['profile_photo'])) {
            $user->profile_photo = $data['profile_photo'];
        }
        $user->role_id = $data['role_id'];
        $user->save();
        return $user;
    }
}
