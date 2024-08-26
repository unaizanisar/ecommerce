@extends('layouts.frontend.app')

@section('title', 'Jay Jewelry | Cart')

@section('content')
<section id="cart-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">
                        <form action="">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @php $total = 0 @endphp
                                        @if(session('cart'))
                                            @foreach(session('cart') as $id => $details)
                                                @php $total += $details['price'] * $details['quantity'] @endphp
                                                <tr>
                                                    <td><img src="{{ asset('uploads/products/' . $details['image']) }}" width="50" height="50" alt="{{ $details['name'] }}"></td>
                                                    <td>{{ $details['name'] }}</td>
                                                    <td>Rs. {{ $details['price'] }}</td>
                                                    <td>{{ $details['quantity'] }}</td>
                                                    <td>Rs. {{ $details['price'] * $details['quantity'] }}</td>
                                                    <td>
                                                        <a href="{{ route('cart.decrease', $id) }}" class="btn btn-warning">-1</a>
                                                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-view-total">
                                <h4>Total: Rs. {{ $total }}</h4>
                                <a href="{{ route('cart.checkout') }}" class="aa-cart-view-btn">Proceed to Checkout</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
