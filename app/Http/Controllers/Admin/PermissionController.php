<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PermissionSaveRequest;
use App\Http\Requests\PermissionUpdateRequest;

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
        if (!auth()->user()->hasPermission('Permission Listing')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Permission Listing!');
        }
        $permissions = $this->permissionRepository->getAllPermissions();
        return view('admin.permissions.permission', compact('permissions'));
    }
    public function create()
    {
        if (!auth()->user()->hasPermission('Permission Add')) {
            return redirect()->route('permissions.index')->with('error', 'You do not have permission to Add Permission!');
        }
        return view('admin.permissions.create');
    }
    public function store(PermissionSaveRequest $request)
    {
        if (!auth()->user()->hasPermission('Permission Add')) {
            return redirect()->route('permissions.index')->with('error', 'You do not have permission to Add Permission!');
        }
        
        $data = $request->all();
        $this->permissionRepository->createPermission($data);
        return redirect()->route('permissions.index')->with('success','Permission created successfully.');
    }
    public function edit($id)
    {
        if (!auth()->user()->hasPermission('Permission Edit')) {
            return redirect()->route('permissions.index')->with('error', 'You do not have permission to Edit Permission!');
        }
        $permission = $this->permissionRepository->getPermissionById($id);
        return view('admin.permissions.edit',compact('permission'));
    }
    public function update($id, PermissionUpdateRequest $request)
    {
        if (!auth()->user()->hasPermission('Permission Edit')) {
            return redirect()->route('permissions.index')->with('error', 'You do not have permission to Edit Permission!');
        }

        $permission = $this->permissionRepository->updatePermission($id, $request->all());
        return redirect()->route('permissions.index')->with('success','Permission Updated Successfully.');
    } 
    public function show($id)
    {
        if (!auth()->user()->hasPermission('Permission Detail')) {
            return redirect()->route('permissions.index')->with('error', 'You do not have permission to view Permission Details!');
        }
        $permission = $this->permissionRepository->getPermissionById($id);
        return view('admin.permissions.show',compact('permission'));
    }
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('Permission Delete')) {
            return redirect()->route('permissions.index')->with('error', 'You do not have permission to Delete Permission!');
        }
        $permission = $this->permissionRepository->deletePermission($id);
        if(!$permission)
        {
            return redirect()->route('permissions.index')->with('error','Permission not found.');
        }
        return redirect()->route('permissions.index')->with('succes','Permission deleted successfully.');
    }
    public function updateStatus($id, $status)
    {
        if (!auth()->user()->hasPermission('Permission Change Status')) {
            return redirect()->route('permissions.index')->with('error', 'You do not have permission to Change Permission Status!');
        }
        $permission = $this->permissionRepository->updatePermissionStatus($id, $status);
        return redirect()->route('permissions.index')->with('success', $status == 1 ? 'Permission activated successfully.':'Permission deactivated successfully.');
    }
}