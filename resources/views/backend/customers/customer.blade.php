@extends('layouts.app')
@section('title', 'Customers')
@section('content')
<div class="container">
    <h2>Customers Listing</h2>
    <div class="text-end">
        <a href="{{ route('customers.create') }}" class="btn btn-success">Add New Customer</a>
    </div>
    <br>
    <div class="table-responsive table--no-card m-b-40">
        <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
    {{-- <table id="customers-table" class="table table-bordered display stripe" width="100%" cellspacing="0" style="text-align: center"> --}}
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $index => $customer)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $customer->firstname }}</td>
                <td>{{ $customer->lastname }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->city }}</td>
                <td>{{ $customer->state }}</td>
                <td>{{ $customer->postal_code }}</td>
                <td>{{ $customer->country }}</td>
                <td>{{ $customer->gender }}</td>
                <td>
                    @if($customer->status == 1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">In-Active</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('customers.show',$customer->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                    <a href="{{ route('customers.edit',$customer->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick = "return confirm('Are you sure you want to delete this customer?');"><i class="fa fa-trash"></i></button>
                    </form> <span style="color:grey">|</span>
                    @if($customer->status==1)
                        <a href="{{ route('customers.updateStatus', ['id' => $customer->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick = "return confirm('Are you sure you want to de-activate this customer?');"><i class="fa fa-user-slash"></i></a>
                    @else
                        <a href = "{{ route('customers.updateStatus', ['id' => $customer->id, 'status' => 1]) }}"class="btn btn-sm btn-success" title="Active" onclick = "return confirm('Are you sure you want to activate this customer?');"><i class="fa fa-user-check"></i></a>
                    @endif
                </td>
            </tr>
            @empty
                <tr style="text-align:center">
                    <td colspan="13">Record Not Found</td>
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