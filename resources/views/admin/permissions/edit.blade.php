@extends('layouts.app')
@section('title', 'Edit Permission')
@section('content')
<div class="container">
            <h1>Edit Permission</h1>
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $permission->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="module">Module</label>
                    <input type="text" class="form-control" id="module" name="module" value="{{ old('module', $permission->module) }}">
                    @error('module')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
</div>
@endsection
