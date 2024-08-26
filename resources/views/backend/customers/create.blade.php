@extends('layouts.app')
@section('title', 'Create Customer')
@section('content')
    <div class="container">
        <h2> Add New Customer</h2>
    <form id="registerForm" method="POST" action="{{ route('customers.store') }}">
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
            <label for="phone">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
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
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
            @if ($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}">
            @if ($errors->has('state'))
                <span class="text-danger">{{ $errors->first('state') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="number" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
            @if ($errors->has('postal_code'))
                <span class="text-danger">{{ $errors->first('postal_code') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
            @if ($errors->has('country'))
                <span class="text-danger">{{ $errors->first('country') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label><br>
            <input type="radio" id="male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
            <label for="female">Female</label><br>
            <input type="radio" id="other" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
            <label for="other">Other</label><br>
            @if ($errors->has('gender'))
                <span class="text-danger">{{ $errors->first('gender') }}</span>
            @endif
        </div>        
        <button type="submit" class="btn btn-success">Register</button>
    </form>
    </div>
@endsection