@extends('layouts.app')
@section('title', 'Add Permission')
@section('content')
    <div class="container">
        <h2> Add New Permission</h2>
    <form id="registerForm" method="POST" action="{{ route('permissions.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="module">Module</label>
            <input type="text" class="form-control" id="module" name="module" value="{{ old('module') }}">
            @if ($errors->has('module'))
                <span class="text-danger">{{ $errors->first('module') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Register</button>
    </form>
    </div>
@endsection