<?php

namespace App\Repositories;
use App\Models\Role;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        $roles = Role::orderBy('id','desc')->get();
        return $roles;
    }
    public function getRoleById($id)
    {
        $role = Role::findOrFail($id);
        return $role;
    }
    public function createRole(array $data)
    {
        $role = new Role();
        $role->name = $data['name'];
        $role->save();
        return $role;
    }
    public function updateRole($id, array $data)
    {
        $role = Role::findOrFail($id);
        $role->name = $data['name'];
        $role->save();
        return $role;
    }
    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        if($role)
        {
            $role->delete();
        }
        return $role;
    }
    public function updateRoleStatus($id, $status)
    {
        $role = Role::findOrFail($id);
        $role->status = $status;
        $role->save();
        return $role;
    }
    public function getPermissionsByModules()
    {
        return Permission::all()->groupBy('module');
    }
    public function roleHasPermissions($roleId, array $permissionIds)
    {
        $role = Role::findOrFail($roleId);
        $role->permissions()->sync($permissionIds);
        return $role;
    }
}