@extends('layouts.frontend.app')

@section('title', 'Checkout')

@section('content')
<section id="checkout">
    <div class="container">
        <div class="row"> 
            <div class="col-md-12">
                <div class="checkout-area">
                    
                    <form action="{{ route('cart.placeOrder') }}" method="POST"> 
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-left">
                                    <h4>Shipping Details</h4>
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your first name." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter your last name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="Enter your postal code" required>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-right">
                                    <h4>Your Order</h4>
                                    <div class="aa-order-summary-area">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($cart as $id => $item)
                                                <tr>
                                                    <td>{{ $item['name'] }} <strong> x {{ $item['quantity'] }}</strong></td>
                                                    <td>Rs. {{ $item['price'] * $item['quantity'] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total</th>
                                                    <td>Rs. {{ $total }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    <button type="submit" class="aa-browse-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
