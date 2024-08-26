@extends('layouts.app')
@section('title', 'Create User')
@section('content')
    <div class="container">
        <h2> Add New User</h2>
    <form id="registerForm" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
            @if ($errors->has('firstname'))
                <span class="text-danger">{{ $errors->first('firstname') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
            @if ($errors->has('lastname'))
                <span class="text-danger">{{ $errors->first('lastname') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            @if ($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div class = "form-group">
            <label for = "role_id">Role</label>
            <select id="role_id" name="role_id" class = "form-control" value="{{ old('role_id') }}">
                <option value = "">Select Role</option>
                @foreach($roles as $role)
                    <option value = "{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('role_id'))
                <span class="text-danger">{{ $errors->first('role_id') }}</span>
            @endif
        </div>
        
        <div class="form-group">
            <label for="profile_photo">Profile Photo</label>
            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
            @if ($errors->has('profile_photo'))
                <span class="text-danger">{{ $errors->first('profile_photo') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Register</button>
    </form>
    </div>
@endsection