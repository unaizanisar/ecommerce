@extends('layouts.frontend.app')

@section('content')
<div class="container">
    <h2>Register</h2>
    <form action="{{ url('/customer/register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required>
            @error('firstname')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
            @error('lastname')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            @error('email')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            @error('password')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            @error('password_confirmation')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone" required>
            @error('phone')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address" required>
            @error('address')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control" placeholder="City" required>
            @error('city')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" name="state" id="state" class="form-control" placeholder="State" required>
            @error('state')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Postal Code" required>
            @error('postal_code')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" name="country" id="country" class="form-control" placeholder="Country" required>
            @error('country')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
