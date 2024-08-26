<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileRepository;
    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function show()
    {
        if (!auth()->user()->hasPermission('Profile View')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Profile!');
        }
        $user = Auth::user();
        $profile = $this->profileRepository->getUserById($user->id);
        return view('admin.profile.profile', compact('profile'));
    }
    public function edit()
    {
        if (!auth()->user()->hasPermission('Profile Edit')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Edit Profile!');
        }
        $user = Auth::user();
        $profile = $this->profileRepository->getUserById($user->id);
        return view('admin.profile.edit', compact('profile'));
    }
    public function update(Request $request)
    {
        if (!auth()->user()->hasPermission('Profile Edit')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to Edit Profile!');
        }
        $user = Auth::user();
        $id = $user->id;
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone,' . $id . '|digits:11',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $this->profileRepository->updateUser($id, $data);
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
