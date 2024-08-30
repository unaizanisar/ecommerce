@extends('layouts.frontend.app')
@section('title', 'Track Your Order')
@section('content')
<section id="track-order">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h2>Track Your Order</h2>
                <form action="{{ route('order.track') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="trackingID">Enter Tracking ID</label>
                        <input type="text" id="trackingID" name="trackingID" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Track</button> <br>
                </form>
                <br>
            </div>
            <br>
        </div>
    </div>
</section>
@endsection
