@extends('layouts.app')
@section('title', 'Add Order')
@section('content')
    <div class="container">
        <h2> Add New Order</h2>
    <form id="registerForm" method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname">First Name</label>
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
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
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
            <label for="postal_code">Postal Code</label>
            <input type="number" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
            @if ($errors->has('postal_code'))
                <span class="text-danger">{{ $errors->first('postal_code') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" class="form-control" id="total" name="total" value="{{ old('total') }}">
            @if ($errors->has('total'))
                <span class="text-danger">{{ $errors->first('total') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Register</button>
    </form>
    </div>
@endsection