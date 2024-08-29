@extends('layouts.app')
@section('title', 'Login')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="wrapper">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>{{ __('Login') }}</h2>
            <div class="input-field"> 
                <input type="email" id="email" name="email" value="{{ old('email') }}"  autofocus class="form-control-user @error('email') is-invalid @enderror" aria-describedby="emailHelp">
                <label for="email">{{ __('Enter your email') }}</label>
                @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                @enderror 
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" autofocus class="form-control-user @error('password') is-invalid @enderror">
                <label for="password">{{ __('Enter your password') }}</label>
                @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                @enderror
            </div>
            <div class="forget">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" style="color: white; margin-left:17px;">
                        {{ __('Remember Me') }}
                    </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                @endif
            </div>
            <button type="submit">{{ __('Login') }}</button>
            <div class="register">
                <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}" style="text-decoration: underline; color:rgb(63, 63, 179)">{{ __('Register') }}</a></p>
            </div>
    </form>
</div>
@endsection