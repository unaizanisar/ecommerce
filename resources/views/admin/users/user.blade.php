@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <div class="container"> 
        <h2> Users Listing</h2>
        <div class="text-end">
            @if(auth()->user()->hasPermission('User Add'))
            <a href="{{ route('users.create') }}" class="btn btn-success">Add New User</a>
            @endif
        </div>
        <br>
        <div class="table-responsive table--no-card m-b-40" style="max-height: 600px; overflow-y: auto;">
            <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
            {{-- <table id="users-table" class="table table-bordered display stripe" width="100%" cellspacing="0" style="text-align: center"> --}}
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ optional($user->role)->name ?? 'No Role' }}</td>
                            <td>
                                @if($user->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">In-Active</span>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->hasPermission('User Detail'))
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                                @endif
                                @if(auth()->user()->hasPermission('User Edit'))
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                                @endif
                                @if(auth()->user()->hasPermission('User Delete'))
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash"></i></button>
                                </form> <span style="color:grey">|</span>
                                @endif
                                @if(auth()->user()->hasPermission('User Change Status'))
                                    @if($user->status == 1)
                                        <a href="{{ route('users.updateStatus', ['id' => $user->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick="return confirm('Are you sure you want to in-active this user?');"><i class="fa fa-user-slash"></i></a>
                                    @else
                                        <a href="{{ route('users.updateStatus', ['id' => $user->id, 'status' => 1]) }}" class="btn btn-sm btn-success" title="Active" onclick="return confirm('Are you sure you want to active this user?');"><i class="fa fa-user-check"></i></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr style="text-align: center">
                            <td colspan="9">Record Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('success') }}");
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.error("{{ session('error') }}");
        });
    </script>
    @endif
    @push('scripts')
    {{-- <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
        </script>         --}}
    @endpush
@endsection
