<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserSaveRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function list()
    {
        return $this->userRepository->getAllUsers();
    }
    public function index()
    {
        if (!auth()->user()->hasPermission('User Listing')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Users Listing!');
        }
        $users = $this->userRepository->getAllUsers();
        return view('admin.users.user', compact('users'));
    }
    
    public function show($id)
    {
        if (!auth()->user()->hasPermission('User Detail')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to view User Details!');
        }
        $user = $this->userRepository->getUsersbyId($id);
        return view('admin.users.show', compact('user'));
    }
    public function create()
    {
        if (!auth()->user()->hasPermission('User Add')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to Add User!');
        }
        $roles = $this->userRepository->getAllRoles();
        return view('admin.users.create', compact('roles'));
    }
    public function store(UserSaveRequest $request)
    {
        if (!auth()->user()->hasPermission('User Add')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to Add User!');
        }
        
        $data = $request->all();
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $data['profile_photo'] = $filename;
            } else {
                return back()->withErrors(['profile_photo' => 'Uploaded file is not valid'])->withInput();
            }
        }  
        $data['password'] = bcrypt($data['password']);
        $this->userRepository->createUser($data);
        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('User Delete')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to Delete User!');
        }
        $user = $this->userRepository->deleteUser($id);
        if(!$user)
        {
            return redirect()->route('users.index')->with('error','User not found.');
        }
        return redirect()->route('users.index')->with('success','User deleted successfully.'); 
    }
    public function updateStatus($id, $status)
    {
        if (!auth()->user()->hasPermission('User Change Status')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to Change User Status!');
        }
        $user = $this->userRepository->updateUserStatus($id, $status);
        return redirect()->route('users.index')->with('success', $status == 1 ? 'User activated successfully.' : 'User deactivated successfully.');
    }
    public function edit($id)
    {
        if (!auth()->user()->hasPermission('User Edit')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to Edit User!');
        }
        $user = $this->userRepository->getUsersbyId($id);
        $roles = $this->userRepository->getAllRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function update($id, UserUpdateRequest $request)
    {
        if (!auth()->user()->hasPermission('User Edit')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to Edit User!');
        }

        $data = $request->all();
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $data['profile_photo'] = $filename;
            } else {
                return back()->withErrors(['profile_photo' => 'Uploaded file is not valid'])->withInput();
            }
        } 
        
        $this->userRepository->updateUser($id, $data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

}
