@extends('layouts.app')
@section('title', 'Edit Order')
@section('content')
<div class="container">
            <h1>Edit Order</h1>
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $order->id }}">
                <div class="form-group">
                    <label for="order_details">Order Details</label>
                    <input type="text" class="form-control" id="order_details" name="order_details" value="{{ old('order_details', $order->order_details) }}">
                    @error('order_details')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="payment_information">Payment Information</label>
                    <input type="text" class="form-control" id="payment_information" name="payment_information" value="{{ old('payment_information', $order->payment_information) }}">
                    @error('payment_information')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
</div>
@endsection
