<!-- start header top  -->
<div class="aa-header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-header-top-area">
                    <div class="aa-header-top-right">
                        <ul class="aa-head-top-nav-right">
                            <li><a href="{{ route('account') }}">My Account</a></li>
                            <li class="hidden-xs"><a href="{{ route('cart') }}">My Cart</a></li>
                            <li class="hidden-xs"><a href="{{ route('cart.checkout') }}">Checkout</a></li>
                            @guest('customer')
                                <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                            @else
                                <li class="hidden-xs"><a href="{{ route('customer.order.details') }}">Order Details</a></li>
                                <li class="hidden-xs"><a href="{{ route('customer.profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                                <li>
                                    <form action="{{ route('customer.logout') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link">Logout</button>
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- / header top  -->
  