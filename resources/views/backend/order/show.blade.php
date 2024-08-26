@extends('layouts.app')
@section('title', 'Order Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        <div class="container mt-5">
            <h2>Order Details</h2>
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
                                    <td><strong>First Name</strong></td>
                                    <td>{{ $order->firstname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Name</strong></td>
                                    <td>{{ $order->lastname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>{{ $order->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City</strong></td>
                                    <td>{{ $order->city }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Postal Code</strong></td>
                                    <td>{{ $order->postal_code }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td>{{ $order->total }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Placed Date</strong></td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('orders.index') }}" class="btn btn-success">Back to orders</a>
            </div>
        </div>
    </div>
</div>
@endsection
