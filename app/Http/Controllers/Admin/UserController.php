<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;
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
        $users =  $this->userRepository->getAllUsers();
        return view('admin.users.user',compact('users'));
    }
    public function show($id)
    {
        $user = $this->userRepository->getUsersbyId($id);
        return view('admin.users.show', compact('user'));
    }
    public function create()
    {
        $roles = $this->userRepository->getAllRoles();
        return view('admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users|digits:11',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'role_id' => 'required|exists:roles,id',
    ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
        $user = $this->userRepository->deleteUser($id);
        if(!$user)
        {
            return redirect()->route('users.index')->with('error','User not found.');
        }
        return redirect()->route('users.index')->with('success','User deleted successfully.'); 
    }
    public function updateStatus($id, $status)
    {
        $user = $this->userRepository->updateUserStatus($id, $status);
        return redirect()->route('users.index')->with('success', $status == 1 ? 'User activated successfully.' : 'User deactivated successfully.');
    }
    public function edit($id)
    {
        $user = $this->userRepository->getUsersbyId($id);
        $roles = $this->userRepository->getAllRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone,' . $id . '|digits:11',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'required|exists:roles,id',
        ]);
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
