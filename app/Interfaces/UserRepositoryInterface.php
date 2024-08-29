<?php

namespace App\Interfaces;
 
interface UserRepositoryInterface 
{
    public function getAllUsers();
    public function getUsersbyId($id);
    public function createUser(array $data);
    public function updateUser($id, array $data);
    public function deleteUser($id);
    public function updateUserStatus($id, $status);
    public function getAllRoles();
}