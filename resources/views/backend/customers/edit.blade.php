@extends('layouts.app')
@section('title', 'Edit Customer')
@section('content')
    <div class="container">
        <h2>Edit Customer</h2> 
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{ $customer->id }}">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $customer->firstname) }}">
                @error('firstname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $customer->lastname) }}">
                @error('lastname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}">
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
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $customer->address) }}">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $customer->city) }}">
                @error('city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $customer->state) }}">
                @error('state')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $customer->postal_code) }}">
                @error('postal_code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $customer->country) }}">
                @error('country')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
       
            <div class="form-group">
                <label>Gender:</label><br>
                <input type="radio" id="male" name="gender" value="male" {{ old('gender', $customer->gender) == 'male' ? 'checked' : '' }}>
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" value="female" {{ old('gender', $customer->gender) == 'female' ? 'checked' : '' }}>
                <label for="female">Female</label><br>
                <input type="radio" id="other" name="gender" value="other" {{ old('gender', $customer->gender) == 'other' ? 'checked' : '' }}>
                <label for="other">Other</label><br>
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
