<?php
namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\User;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function getAllUsers()
    {
        return User::orderBy('id', 'desc')->get();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->fill($data);
        $user->save();
        return $user;
    }
}
