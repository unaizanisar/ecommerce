@extends('layouts.app')
@section('title', 'Permissions')
@section('content')
<div class="container">
    <h2>Permissions Listing</h2>
    <div class="text-end">
        <a href="{{ route('permissions.create') }}" class="btn btn-success">Add New Permission</a>
    </div>
    <br>
    <div class="table-responsive table--no-card m-b-40" style="max-height: 600px; overflow-y: auto;">
    <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
    {{-- <table id = "permissions-table" class="table table-bordered display stripe" cellspacing="0" width="100%" style="text-align: center"> --}}
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Module</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permissions as $index => $permission)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->module }}</td>
                <td>
                    @if($permission->status==1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">In-Active</span>
                    @endif
                </td>
                <td> 
                <a href="{{ route('permissions.show',$permission->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick = "return confirm('Are you sure you want to delete this permission?');"><i class="fa fa-trash"></i></button>
                </form> <span style="color:grey">|</span>
                @if($permission->status==1)
                    <a href="{{ route('permissions.updateStatus', ['id' => $permission->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick ="return confirm('Are you sure you want to de-activate this permission?');">
                        <i class="fa fa-user-slash"></i>
                    </a>
                @else
                    <a href="{{ route('permissions.updateStatus', ['id' => $permission->id, 'status' => 1]) }}" class="btn btn-sm btn-success" title="Active" onclick ="return confirm('Are you sure you want to activate this permission?');">
                        <i class="fa fa-user-check"></i>
                    </a>
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