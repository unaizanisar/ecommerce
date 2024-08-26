@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<div class="container">
    <h2>Categories Listing</h2>
    <div class="text-end">
        @if(auth()->user()->hasPermission('Category Add'))
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add New Category</a>
        @endif
    </div>
    <br>
    <div class="table-responsive table--no-card m-b-40">
        <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
    {{-- <table id="categories-table" class="table table-bordered display stripe" width="100%" cellspacing="0" style="text-align: center"> --}}
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    @if($category->image)
                        <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Category Image" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>
                    @if($category->status == 1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">In-Active</span>
                    @endif
                </td>
                <td>
                    @if(auth()->user()->hasPermission('Category Detail'))
                    <a href="{{ route('categories.show',$category->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                    @endif
                    @if(auth()->user()->hasPermission('Category Edit'))
                    <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                    @endif
                    @if(auth()->user()->hasPermission('Category Delete'))
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick = "return confirm('Are you sure you want to delete this category?');"><i class="fa fa-trash"></i></button>
                    </form> <span style="color:grey">|</span>
                    @endif
                    @if(auth()->user()->hasPermission('Category Change Status'))
                    @if($category->status==1)
                        <a href="{{ route('categories.updateStatus', ['id' => $category->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick = "return confirm('Are you sure you want to de-activate this category?');"><i class="fa fa-user-slash"></i></a>
                    @else
                        <a href = "{{ route('categories.updateStatus', ['id' => $category->id, 'status' => 1]) }}"class="btn btn-sm btn-success" title="Active" onclick = "return confirm('Are you sure you want to activate this category?');"><i class="fa fa-user-check"></i></a>
                    @endif
                    <span style="color:grey">|</span>
                    @endif
                    @if(auth()->user()->hasPermission('Category Home'))
                    @if($category->is_home==1)
                        <a href="{{ route('categories.updateHome', ['id' => $category->id, 'is_home' => 0]) }}" class="btn btn-sm btn-secondary" title="Remove from home" onclick = "return confirm('Are you sure you want to remove this category from home?');"><i class="fa-solid fa-house-circle-xmark"></i></a>
                    @else
                        <a href = "{{ route('categories.updateHome', ['id' => $category->id, 'is_home' => 1]) }}"class="btn btn-sm btn-secondary" title="Add on home screen" onclick = "return confirm('Are you sure you want to add this category to home?');"><i class="fa-solid fa-house-laptop"></i></a>
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