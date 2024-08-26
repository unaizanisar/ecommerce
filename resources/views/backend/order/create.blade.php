@extends('layouts.app')
@section('title', 'Add Order')
@section('content')
    <div class="container">
        <h2> Add New Order</h2>
    <form id="registerForm" method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="order_details">Order Details</label>
            <input type="text" class="form-control" id="order_details" name="order_details" value="{{ old('order_details') }}">
            @if ($errors->has('order_details'))
                <span class="text-danger">{{ $errors->first('order_details') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="payment_information">Payment Information</label>
            <input type="text" class="form-control" id="payment_information" name="payment_information" value="{{ old('payment_information') }}">
            @if ($errors->has('payment_information'))
                <span class="text-danger">{{ $errors->first('payment_information') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Register</button>
    </form>
    </div>
@endsection