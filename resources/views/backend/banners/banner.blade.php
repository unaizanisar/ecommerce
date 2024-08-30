@extends('layouts.app')
@section('title', 'Banners')
@section('content')
<div class="container">
    <h2>Banners Listing</h2>
    <div class="text-end">
        <a href="{{ route('banners.create') }}" class="btn btn-success">Add New Banner</a>
    </div>
    <br>
    <div class="table-responsive table--no-card m-b-40">
        <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
    {{-- <table id="categories-table" class="table table-bordered display stripe" width="100%" cellspacing="0" style="text-align: center"> --}}
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Button Text</th>
                <th>Button Link</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($banners as $index => $banner)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $banner->description }}</td>
                <td>{{ $banner->btn_text }}</td>
                <td>{{ $banner->btn_link }}</td>
                <td>
                    @if($banner->image)
                        <img src="{{ asset('uploads/banner/' . $banner->image) }}" alt="Banner Image" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>
                    @if($banner->status == 1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">In-Active</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('banners.show',$banner->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                    <a href="{{ route('banners.edit',$banner->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                    <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick = "return confirm('Are you sure you want to delete this banner?');"><i class="fa fa-trash"></i></button>
                    </form> <span style="color:grey">|</span>
                    @if($banner->status==1)
                        <a href="{{ route('banners.updateStatus', ['id' => $banner->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick = "return confirm('Are you sure you want to de-activate this banner?');"><i class="fa fa-user-slash"></i></a>
                    @else
                        <a href = "{{ route('banners.updateStatus', ['id' => $banner->id, 'status' => 1]) }}"class="btn btn-sm btn-success" title="Active" onclick = "return confirm('Are you sure you want to activate this banner?');"><i class="fa fa-user-check"></i></a>
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
<script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
        </script>        
@endpush
@endsection