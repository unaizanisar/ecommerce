<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return response()->json($users, 200);
    }
    public function show($id)
    {
        try{
            $user = $this->userRepository->getUsersById($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'User not found'],404);
        }
        return response()->json($user, 200);
    }
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'firstname' => 'required|string|max:255', 
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|unique:users|digits:11',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'role_id' => 'required|exists:roles,id',
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            $data = $request->all();
            if($request->hasFile('profile_photo'))
            {
                $file = $request->file('profile_photo');
                if ($file->isValid()) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $filename);
                    $data['profile_photo'] = $filename;
                } else {
                    return response()->json(['profile_photo' => 'Uploaded file is not valid'], 422);
                }
            }
            $data['password'] = bcrypt($data['password']);
            $user = $this->userRepository->createUser($data);
            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (\Exception $e){
            return response()->json(['error'=>'An error occured while creating user', 'message'=>$e->getMessage()], 500);
        }
    }
    public function update($id, Request $request)
    {
        try{
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
                    return response()->json(['profile_photo' => 'Uploaded file is not valid'], 422);
                }
            }

            $user = $this->userRepository->updateUser($id, $data);
            return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error'=>'An error occured while updating user', 'message'=>$e->getMessage()],500);
        }
    }
    public function destroy($id)
    {
        try{
            $order = $this->userRepository->deleteUser($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'User not found'], 404);
        }
        return response()->json(['message'=>'User deleted successfully'], 200);
    }
    public function updateStatus($id, $status)
    {
        try{
            $user = $this->userRepository->updateUserStatus($id, $status);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'User not found'], 404);
        }
        $message = $status == 1 ? 'User activated successfully':'User deactivated successfully';
        return response()->json(['message'=>$message], 200);
    }
}
