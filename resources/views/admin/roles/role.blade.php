@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="container">
    <h2>Roles Listing</h2>
    <div class="text-end">
        @if(auth()->user()->hasPermission('Role Add'))
        <a href="{{ route('roles.create') }}" class="btn btn-success">Add New Role</a>
        @endif
    </div>
    <br>
    <div class="table-responsive table--no-card m-b-40">
        <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
    {{-- <table id="roles-table" class="table table-bordered display stripe" width="100%" cellspacing="0" style="text-align: center"> --}}
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead> 
        <tbody>
            @forelse($roles as $index => $role)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @if($role->status == 1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">In-Active</span>
                    @endif
                </td>
                <td>
                @if(auth()->user()->hasPermission('Role Detail'))
                    <a href="{{ route('roles.show',$role->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                @endif
                @if(auth()->user()->hasPermission('Role Edit'))
                    <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                @endif
                @if(auth()->user()->hasPermission('Role Delete'))
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick = "return confirm('Are you sure you want to delete this role?');"><i class="fa fa-trash"></i></button>
                    </form> <span style="color:grey">|</span>
                @endif
                @if(auth()->user()->hasPermission('Role Change Status'))
                    @if($role->status==1)
                        <a href="{{ route('roles.updateStatus', ['id' => $role->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick = "return confirm('Are you sure you want to de-activate this role?');"><i class="fa fa-user-slash"></i></a>
                    @else
                        <a href = "{{ route('roles.updateStatus', ['id' => $role->id, 'status' => 1]) }}"class="btn btn-sm btn-success" title="Active" onclick = "return confirm('Are you sure you want to activate this role?');"><i class="fa fa-user-check"></i></a>
                    @endif
                @endif
                </td>
            </tr>
            @empty
                <tr style="text-align:center">
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

@push('scripts')
{{-- <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
        </script>         --}}
@endpush
@endsection