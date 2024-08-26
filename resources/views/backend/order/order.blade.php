@extends('layouts.app')
@section('title', 'Orders')
@section('content')
    <div class="container">
        <h2> Orders Listing</h2>
        <div class="text-end">
            <a href="{{ route('orders.create') }}" class="btn btn-success">Add New Order</a>
        </div>
        <br>
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning" width="100%" cellspacing="0" style="text-align: center">
            {{-- <table id="orders-table" class="table table-bordered display stripe" width="100%" cellspacing="0" style="text-align: center"> --}}
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Details</th>
                        <th>Payment Information</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->order_details }}</td>
                            <td>{{ $order->payment_information }}</td>
                            <td>
                                @if($order->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">In-Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i></a> <span style="color:grey">|</span>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pen"></i></a> <span style="color:grey">|</span>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this order?');"><i class="fa fa-trash"></i></button>
                                </form> <span style="color:grey">|</span>
                                @if($order->status == 1)
                                    <a href="{{ route('orders.updateStatus', ['id' => $order->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="In-Active" onclick="return confirm('Are you sure you want to in-active this order?');"><i class="fa fa-user-slash"></i></a>
                                @else
                                    <a href="{{ route('orders.updateStatus', ['id' => $order->id, 'status' => 1]) }}" class="btn btn-sm btn-success" title="Active" onclick="return confirm('Are you sure you want to active this order?');"><i class="fa fa-user-check"></i></a>
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

    @push('scripts')
{{-- <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
        </script>         --}}
    @endpush
@endsection
