@extends('layouts.app')
@section('title', 'User Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        <div class="container mt-5">
            <h2>User Details</h2>
            <div class="row justify-content-center m-t-30">
                <div class="col-md-7">
                    <div class="text-center mb-4">
                        @if ($user->profile_photo)
                            <img src="{{ asset('uploads/' . $user->profile_photo) }}" class="rounded-circle" alt="{{ $user->fullname }}" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('default-avatar.png') }}" class="rounded-circle" alt="Default Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="table-responsive m-b-30">
                        <table class="table table-borderless table-data3 mx-auto">
                            <thead>
                                <th>Field</th>
                                <th>Value</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>First Name</strong></td>
                                    <td>{{ $user->firstname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Name</strong></td>
                                    <td>{{ $user->lastname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('users.index') }}" class="btn btn-success">Back to Users</a>
            </div>
        </div>
    </div>
</div>
@endsection
