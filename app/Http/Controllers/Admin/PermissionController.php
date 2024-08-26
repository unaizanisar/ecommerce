<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    protected $permissionRepository;
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function list()
    {
        $permission = $this->permissionRepository->getAllPermissions();
        return $permission;
    }
    public function index()
    {
        $permissions = $this->permissionRepository->getAllPermissions();
        return view('admin.permissions.permission', compact('permissions'));
    }
    public function create()
    {
        return view('admin.permissions.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'module'=>'required|string|max:255',
        ]);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $this->permissionRepository->createPermission($data);
        return redirect()->route('permissions.index')->with('success','Permission created successfully.');
    }
    public function edit($id)
    {
        $permission = $this->permissionRepository->getPermissionById($id);
        return view('admin.permissions.edit',compact('permission'));
    }
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'module' => 'required|string|max:255',
        ]);
        $permission = $this->permissionRepository->updatePermission($id, $request->all());
        return redirect()->route('permissions.index')->with('success','Permission Updated Successfully.');
    }
    public function show($id)
    {
        $permission = $this->permissionRepository->getPermissionById($id);
        return view('admin.permissions.show',compact('permission'));
    }
    public function destroy($id)
    {
        $permission = $this->permissionRepository->deletePermission($id);
        if(!$permission)
        {
            return redirect()->route('permissions.index')->with('error','Permission not found.');
        }
        return redirect()->route('permissions.index')->with('succes','Permission deleted successfully.');
    }
    public function updateStatus($id, $status)
    {
        $permission = $this->permissionRepository->updatePermissionStatus($id, $status);
        return redirect()->route('permissions.index')->with('success', $status == 1 ? 'Permission activated successfully.':'Permission deactivated successfully.');
    }
}