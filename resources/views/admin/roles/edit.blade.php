@extends('layouts.app')
@section('title', 'Edit Role')
@section('content')
    <div class="container">
        <h2>Edit Role</h2>
        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Permissions</label>
                @foreach($permissions as $module => $permissionsByModule)
                    <div class="form-group">
                        <h5>{{ $module }}</h5>
                        @foreach($permissionsByModule as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @error('permissions')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Update Role</button>
        </form>
    </div>
@endsection
