<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getPermissionsByModules()
    {
        return Permission::all()->groupBy('module');
    }
    public function getAllPermissions()
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        return $permissions;
    }
    public function getPermissionById($id)
    {
        $permission = Permission::findOrFail($id);
        return $permission;
    }
    public function createPermission(array $data)
    {
        return Permission::create($data);
    }
    public function updatePermission($id, array $data)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($data);
        return $permission;
    }
    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);
        if($permission)
        {
            $permission->delete();
        }
        return $permission;
    }
    public function updatePermissionStatus($id, $status)
    {
        $permission = Permission::findOrFail($id);
        $permission->status = $status;
        $permission->save();
        return $permission;
    }
}