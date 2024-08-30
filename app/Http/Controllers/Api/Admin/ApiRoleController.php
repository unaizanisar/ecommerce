<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\RoleRepositoryInterface;

class ApiRoleController extends Controller
{
    protected $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
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
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
            ]);
            if($validator->fails()){
                return response()->json(['error'=> $validator->errors()], 422);
            }
            $data = $request->all();
            $role = $this->roleRepository->createRole($data);
            return response()->json(['role'=>$role, 'message'=>'Role created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error'=>'An error occured while creating role', 'message'=>$e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $role = $this->roleRepository->getRoleById($id);
            if(!$role)
            {
                return response()->json(['error'=>'Role not found'], 404);
            }
            $data = $validatedData;
            $this->roleRepository->updateRole($id, $data);
            return response()->json(['message'=>'Role updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occured while updating the role', 'message'=>$e->getMessage()], 500);
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
