@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="container">
    <h2>Products Listing</h2>
    <div class="text-end">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
    </div>
    <br> 
    <div class="table-responsive table--no-card m-b-40" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
    {{-- <table id="products-table" class="table table-bordered display stripe" width="100%" cellspacing="0" style="text-align: center"> --}}
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                {{-- <th>Description</th> --}}
                {{-- <th>Category</th> --}}
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                {{-- <td>{{ $product->description }}</td> --}}
                {{-- <td>{{ $product->category->name ?? 'No Category' }}</td> --}}
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if($product->images)
                        <img src="{{ asset('uploads/products/' . $product->images) }}" alt="Product Image" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>
                    @if($product->status == 1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">In-Active</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.show',$product->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick = "return confirm('Are you sure you want to delete this product?');"><i class="fa fa-trash"></i></button>
                    </form> <span style="color:grey">|</span>
                    @if($product->status==1)
                        <a href="{{ route('products.updateStatus', ['id' => $product->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick = "return confirm('Are you sure you want to de-activate this product?');"><i class="fa fa-user-slash"></i></a>
                    @else
                        <a href = "{{ route('products.updateStatus', ['id' => $product->id, 'status' => 1]) }}"class="btn btn-sm btn-success" title="Active" onclick = "return confirm('Are you sure you want to activate this product?');"><i class="fa fa-user-check"></i></a>
                    @endif
                    <span style="color:grey">|</span>
                    @if($product->is_featured==1)
                        <a href="{{ route('products.updateFeatured', ['id' => $product->id, 'is_featured' => 0]) }}" class="btn btn-sm btn-warning" title="Un-Feature" onclick = "return confirm('Are you sure you want to remove this product from featured?');"><i class="fa-solid fa-toggle-on"></i></a>
                    @else
                        <a href = "{{ route('products.updateFeatured', ['id' => $product->id, 'is_featured' => 1]) }}"class="btn btn-sm btn-warning" title="Feature" onclick = "return confirm('Are you sure you want to feature this product?');"><i class="fa-solid fa-toggle-off"></i></a>
                    @endif
                    <span style="color:grey">|</span>
                    @if($product->is_home==1)
                        <a href="{{ route('products.updateHome', ['id' => $product->id, 'is_home' => 0]) }}" class="btn btn-sm btn-secondary" title="Remove from home" onclick = "return confirm('Are you sure you want to remove this product from home?');"><i class="fa-solid fa-house-circle-xmark"></i></a>
                    @else
                        <a href = "{{ route('products.updateHome', ['id' => $product->id, 'is_home' => 1]) }}"class="btn btn-sm btn-secondary" title="Add on home screen" onclick = "return confirm('Are you sure you want to add this product to home?');"><i class="fa-solid fa-house-laptop"></i></a>
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