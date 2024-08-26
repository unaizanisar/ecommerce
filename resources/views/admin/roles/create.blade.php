@extends('layouts.app')
@section('title', 'Add Role')
@section('content')
    <div class="container">
        <h2>Add New Role</h2>
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
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
                                <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
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
            <button type="submit" class="btn btn-success">Create Role</button>
        </form>
    </div>
@endsection
