<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\PermissionRepositoryInterface;

class ApiPermissionController extends Controller
{
    protected $permissionRepository;
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function index()
    {
        $permissions = $this->permissionRepository->getAllPermissions();
        return response()->json($permissions, 200);
    }
    public function show($id)
    {
        try{
            $permission = $this->permissionRepository->getPermissionById($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Permission not found'], 404);
        }
        return response()->json($permission, 200);
    }
    public function store(Request $request)
    {
        try{ 
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'module' => 'required|string|max:255',
            ]);
            if($validator->fails())
            {
                return response()->json(['error'=>$validator->errors()], 422);
            }
            $data = $request->all();
            $permission = $this->permissionRepository->createPermission($data);
            return response()->json(['permission'=> $permission ,'message'=>'Permission created successfully'], 201);
        } catch (\Exception $e){
            return response()->json(['error'=>'An error occured while creating permission', 'message'=>$e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $validatedData = $request->validate([
                'name'=>'required|string|max:255',
                'module'=>'required|string|max:255',
            ]);
            $permission = $this->permissionRepository->getPermissionById($id);
            if(!$permission)
            {
                return response()->json(['error'=>'Permission not found'], 404);
            }
            $data = $validatedData;
            $this->permissionRepository->updatePermission($id, $data);
            return response()->json(['message'=>'Permission updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error'=>'An error occured while updating permission', 'message'=>$e->getMessage()],500);
        }
    }
    public function destroy($id)
    {
        try{
            $permission = $this->permissionRepository->deletePermission($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Permission not found'], 404);
        }
        return response()->json(['message'=>'Permission deleted successfully'], 200);
    }
    public function updateStatus($id, $status)
    {
        try{
            $permission = $this->permissionRepository->updatePermissionStatus($id, $status);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Permission not found'], 404);
        }
        $message = $status == 1 ? 'Permission activated successfully':'Permission deactivated successfully';
        return response()->json(['message'=>$message], 200);
    }
}
