@extends('layouts.frontend.app')
@section('title', 'Order Tracking Result')
@section('content')
<section id="track-result" class="custom-track-result">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header text-center ">
                <h2>Order Tracking Details</h2>
            </div>
            <div class="card-body">
                <p><strong>Tracking ID:</strong> {{ $order->tracking_id }}</p>
                <p><strong>Order Total:</strong> Rs. {{ $order->total }}</p>
                <p><strong>Status:</strong>
                @if($order->status == 'in_process')
                    <span class="badge badge-warning">In Process</span>
                @elseif($order->status == 'delivered')
                    <span class="badge badge-success">Delivered</span>
                @elseif($order->status == 'cancelled')
                    <span class="badge badge-danger">Cancelled</span>
                @endif
                </p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>

</section>
@endsection
