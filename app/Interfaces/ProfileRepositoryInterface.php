<?php
namespace App\Interfaces;

interface ProfileRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function updateUser($id, array $data);
}
