@extends('layouts.app')
@section('title', 'Register')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="wrapper">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>{{ __('Register') }}</h2>
        <div class="input-field">
            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" autofocus class="form-control-user @error('firstname') is-invalid @enderror">
            <label for="firstname">{{ __('First Name') }}</label>
            @error('firstname')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="input-field">
            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" autofocus class="form-control-user @error('lastname') is-invalid @enderror">
            <label for="lastname">{{ __('Last Name') }}</label>
            @error('lastname')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="input-field">
            <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus class="form-control-user @error('email') is-invalid @enderror" aria-describedby="emailHelp">
            <label for="email">{{ __('Email') }}</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-field">
            <input type="password" id="password" name="password" value="{{ old('password') }}" autofocus class="form-control-user @error('password') is-invalid @enderror">
            <label for="password">{{ __('Password') }}</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-field">
            <input type="password" id="password-confirm" name="password_confirmation" autofocus class="form-control-user @error('password') is-invalid @enderror">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-field">
            <input type="address" id="address" name="address" value="{{ old('address') }}" autofocus class="form-control-user @error('address') is-invalid @enderror">
            <label for="address">{{ __('Address') }}</label>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-field">
            <input type="phone" id="phone" name="phone" value="{{ old('phone') }}" autofocus class="form-control-user @error('phone') is-invalid @enderror">
            <label for="phone">{{ __('Phone') }}</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>  
        <button type="submit">{{ __('Register') }}</button>
        <div class="register">
            <p>{{ __("Already have an account?") }} <a href="{{ route('login') }}" style="text-decoration:underline; color:rgb(63, 63, 179)">{{ __('Login') }}</a></p>
        </div>
    </form>
</div>
@endsection
