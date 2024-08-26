@extends('layouts.app')
@section('title', 'Role Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        <div class="container mt-5">
            <h2>Role Details</h2>
            <div class="row justify-content-center m-t-30">
                <div class="col-md-7">
                    <div class="table-responsive m-b-30">
                        <table class="table table-borderless table-data3 mx-auto">
                            <thead>
                                <th>Field</th>
                                <th>Value</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('roles.index') }}" class="btn btn-success">Back to roles</a>
            </div>
        </div>
    </div>
</div>
@endsection
