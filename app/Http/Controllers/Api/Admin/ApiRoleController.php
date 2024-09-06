<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\RoleRepositoryInterface; 
use App\Interfaces\PermissionRepositoryInterface;
use App\Http\Requests\RoleSaveRequest;
use App\Http\Requests\RoleUpdateRequest;

class ApiRoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;
    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    public function index()
    {
        try{
            $roles = $this->roleRepository->getAllRoles();
        } catch(\Exception $e) {
            return response()->json(['error'=>'There is an error displaying all roles'], 500);
        }
        return response()->json($roles, 200);
    }
    public function show($id)
    {
        try{
            $role = $this->roleRepository->getRoleById($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Role not found'], 404);
        }
        return response()->json($role, 200);
    }
    public function store(RoleSaveRequest $request)
    {
        try {
            $data = $request->all();
            $role = $this->roleRepository->createRole($data);
            $this->roleRepository->roleHasPermissions($role->id, $request->input('permissions', []));

            return response()->json(['role' => $role, 'message' => 'Role created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the role', 'message' => $e->getMessage()], 500);
        }
    }
    public function update(RoleUpdateRequest $request, $id)
    {
        try{
            $role = $this->roleRepository->getRoleById($id);
            if(!$role)
            {
                return response()->json(['error', 'Role not found'], 404);
            }
            $this->roleRepository->updateRole($id, $request->all());
            $this->roleRepository->roleHasPermissions($role->id, $request->input('permissions',[]));
            return response()->json([
                'message'=>'Role updated successfully',
                'role' => $role
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occured while updating role',
                'message' => $e->getMessage()
                
            ],500);
        }
    }
    public function destroy($id)
    {
        try{
            $role = $this->roleRepository->deleteRole($id);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Role not found'], 404);
        }
        return response()->json(['message'=>'Role deleted successfully'], 200);
    }
    public function updateStatus($id, $status)
    {
        try{
            $role = $this->roleRepository->updateRoleStatus($id, $status);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Role not found'], 404);
        }
        $message = $status == 1? 'Role activated successfully' : 'Role deactivated successfully';
        return response()->json(['message'=> $message], 200);
    }
}
