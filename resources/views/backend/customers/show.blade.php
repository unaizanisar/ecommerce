@extends('layouts.app')
@section('title', 'Customer Details')
@section('content')
        <div class="container">
            <h2 class="text-center">Customer Details</h2>
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
                                    <td>{{ $customer->firstname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Name</strong></td>
                                    <td>{{ $customer->lastname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td>{{ $customer->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City</strong></td>
                                    <td>{{ $customer->city }}</td>
                                </tr>
                                <tr>
                                    <td><strong>State</strong></td>
                                    <td>{{ $customer->state }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Postal Code</strong></td>
                                    <td>{{ $customer->postal_code }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Country</strong></td>
                                    <td>{{ $customer->country }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Gender</strong></td>
                                    <td>{{ $customer->gender }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('customers.index') }}" class="btn btn-success">Back to Customers</a>
            </div>
        </div>
@endsection

