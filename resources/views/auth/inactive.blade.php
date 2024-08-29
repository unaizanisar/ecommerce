@extends('layouts.app')
@section('title', 'Account Inactive')
@section('content')
<div class="container">
    <h1>
        <br>
    </h1>
    <h1 style="text-align: center">
        Your account is inactive. Please contact admin assistance.
    </h1>
    <div style="width: 50%; height: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto;">
        <img src="{{ asset('images/4705517.jpg') }}" alt="Inactive Image">
        <br>
    </div>  
    <div style="display: flex; justify-content: center;">
        <a href="{{ route('login') }}" title="Login" class="btn btn-sm btn-success">Login</a>
    </div>    
</div>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.success("{{ session('success') }}");
    });
</script>
@endif

@push('scripts')
@endpush
@endsection