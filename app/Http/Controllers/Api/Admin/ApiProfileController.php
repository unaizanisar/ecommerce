<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ProfileRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ApiProfileController extends Controller
{
    protected $profileRepository;
    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function show()
    {
        try{
            $user = Auth::user();
            $profile = $this->profileRepository->getUserById($user->id);
            return response()->json([
                'success' => true,
                'profile' => $profile
            ]);
        } catch(Exception $e) {
            return response()->json(['error'=>'An error occured while retreiving the profile', 'message'=>$e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {

            $user = Auth::user();
            $id = $user->id;

            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|unique:users,phone,' . $id . '|digits:11',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
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
                    return response()->json([
                        'success' => false,
                        'message' => 'Uploaded file is not valid'
                    ], 400);
                }
            }

            $profile = $this->profileRepository->updateUser($id, $data);
            return response()->json([
                'profile' => $profile,
                'message' => 'Profile updated successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the profile.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}