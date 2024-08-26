@extends('layouts.app')
@section('title', 'Edit profile')
@section('content')
    <div class="container">
        <h2>Edit profile</h2> 
        <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{ $profile->id }}">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $profile->firstname) }}">
                @error('firstname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $profile->lastname) }}">
                @error('lastname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $profile->email) }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $profile->address) }}">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="profile_photo">Profile Photo</label>
                <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                @if ($profile->profile_photo)
                    <div class="mt-2"> 
                        <img src="{{ asset('uploads/' . $profile->profile_photo) }}" alt="Profile Photo" class="img-fluid" style ="max-width: 150px; height: auto;">
                    </div>
                @endif
                @error('profile_photo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
