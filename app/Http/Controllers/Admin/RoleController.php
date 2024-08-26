<?php

namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
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
        $roles = $this->roleRepository->getAllRoles();
        return view('admin.roles.role',compact('roles'));
    }
    public function create()
    {
        $permissions = $this->permissionRepository->getPermissionsByModules();
        return view('admin.roles.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'array', 
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role = $this->roleRepository->createRole($request->all());
        $this->roleRepository->roleHasPermissions($role->id, $request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }
    public function show($id)
    {
        $role = $this->roleRepository->getRoleById($id);
        return view('admin.roles.show',compact('role'));
    }
    public function edit($id)
    {
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $this->permissionRepository->getPermissionsByModules();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role = $this->roleRepository->updateRole($id, $request->all());
        $this->roleRepository->roleHasPermissions($role->id, $request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
    public function destroy($id)
    {
        $role = $this->roleRepository->deleteRole($id);
        if(!$role)
        {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
    public function updateStatus($id,$status)
    {
        $role = $this->roleRepository->updateRoleStatus($id, $status);
        return redirect()->route('roles.index')->with('success', $status == 1 ? 'Role activated successfully.':'Role deactivated successfully.');
    }
}
