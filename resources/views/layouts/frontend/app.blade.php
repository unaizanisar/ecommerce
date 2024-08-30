<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>@yield('title')</title>
    <!-- Font awesome -->
    <link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap -->
    <link href="{{ asset('frontend/css/bootstrap.css')}}" rel="stylesheet">   
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ asset('frontend/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.simpleLens.css')}}">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick.css')}}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/nouislider.css')}}">
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('frontend/css/theme-color/dark-red-theme.css')}}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{ asset('frontend/css/sequence-theme.modern-slide-in.css')}}" rel="stylesheet" media="all">
    <!-- Main style sheet -->
    <link href="{{ asset('frontend/css/style.css')}}" rel="stylesheet">    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> 
    <![endif]-->
    <style>
      /* Custom styling for the order tracking result section */
  .custom-track-result {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 80vh;
      background-color: #f8f9fa; /* Light background color for contrast */
      padding: 20px;
  }
  
  .custom-track-result .card {
      border-radius: 8px; /* Rounded corners for the card */
      border: 1px solid #dee2e6; /* Light border for the card */
  }
  
 
  .custom-track-result .card-body {
      padding: 20px;
  }
  
  .custom-track-result .card-footer {
      background-color: #f1f1f1; /* Slightly different background for the footer */
      border-top: 1px solid #dee2e6; /* Border at the top of the footer */
  }
  
    </style>
  </head>
  
  <body> 
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->
  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <li><a href="account.html">My Account</a></li>
                  <li class="hidden-xs"><a href="{{ route('cart') }}">My Cart</a></li>
                  <li class="hidden-xs"><a href="{{ route('cart.checkout') }}">Checkout</a></li>
                  <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->
    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{{ url('/home') }}">
                  <span class="far fa-gem"></span>
                  <p>Jay's<strong>Jewellery</strong> <span>Elegance your way!</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
<div class="aa-cartbox">
  <a class="aa-cart-link" href="{{ route('cart') }}">
      <span class="fa fa-shopping-basket"></span>
      <span class="aa-cart-title">CART</span>
      <span class="aa-cart-notify">{{ count(session('cart', [])) }}</span> <!-- Cart item count -->
  </a>
  <div class="aa-cartbox-summary">
      @if(session('cart') && count(session('cart')) > 0)
          <ul>
              @foreach(session('cart') as $id => $details)
                  <li>
                      <a class="aa-cartbox-img" href="#"><img src="{{ asset('uploads/products/' . $details['image']) }}" alt="{{ $details['name'] }}"></a>
                      <div class="aa-cartbox-info">
                          <h4><a href="#">{{ $details['name'] }}</a></h4>
                          <p>{{ $details['quantity'] }} x Rs. {{ $details['price'] }}</p>
                      </div>
                      <a class="aa-remove-product" href="{{ route('cart.remove', $id) }}"><span class="fa fa-times"></span></a>
                  </li>
              @endforeach
              <li>
                  <span class="aa-cartbox-total-title">
                      Total
                  </span>
                  <span class="aa-cartbox-total-price">
                      ${{ array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart'))) }}
                  </span>
              </li>
          </ul>
          <a class="aa-cartbox-checkout aa-primary-btn" href="{{ route('cart.checkout') }}">Checkout</a>
      @else
          <p>Your cart is empty.</p>
      @endif
  </div>
</div>
<!-- / cart box -->
        <!-- search box -->
        <div class="aa-search-box">
          <form action="{{ route('search') }}" method="GET">
              <input type="text" name="query" id="searchQuery" placeholder="Search here ex. 'man' ">
              <button type="submit"><span class="fa fa-search"></span></button>
          </form>
        </div>
        <!-- / search box -->
     
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
    <!-- menu -->
    <section id="menu">
      <div class="container">
          <div class="menu-area">
              <!-- Navbar -->
              <div class="navbar navbar-default" role="navigation">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>          
                  </div>
                  <div class="navbar-collapse collapse">
                      <!-- Left nav -->
                      {!! getNavCategories() !!}
                  </div><!--/.nav-collapse -->
              </div>
          </div>       
      </div>
  </section>
  
      <!-- / menu -->
  @yield('content')
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  <!-- Testimonial -->
  <section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{ asset('images/jaylogo.jpeg') }}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Every testimonial is a story of partnership and progress.  Discover how together, we create the unimaginable!.</p>
                  <div class="aa-testimonial-info">
                    <p>Allison</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Testimonial -->

  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="{{ route('product.viewProducts') }}">Our Products</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Delivery</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Discount</a></li>
                      <li><a href="#">Special Offer</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Site Map</a></li>
                      <li><a href="#">Search</a></li>
                      <li><a href="#">Advanced Search</a></li>
                      <li><a href="#">Suppliers</a></li>
                      <li><a href="#">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p> 25 Astor Pl, NY 10003, USA</p>
                      <p><span class="fa fa-phone"></span>+1 212-982-4589</p>
                      <p><span class="fa fa-envelope"></span>dailyshop@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="https://www.facebook.com/yourprofile" target="_blank">
                          <span class="fab fa-facebook-f"></span>
                      </a>
                      <a href="https://twitter.com/yourprofile" target="_blank">
                          <span class="fab fa-twitter"></span>
                      </a>
                      <a href="https://plus.google.com/yourprofile" target="_blank">
                          <span class="fab fa-google-plus-g"></span>
                      </a>
                      <a href="https://www.youtube.com/yourchannel" target="_blank">
                          <span class="fab fa-youtube"></span>
                      </a>
                  </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area" >
            <p>Designed by <a href="{{ route('home') }}">Jays Jewellery</a></p>
            <div class="aa-footer-payment">
              <span class="fa fa-instagram"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->

  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="">
            <label for="">Username or Email address<span>*</span></label>
            <input type="text" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <div class="aa-register-now">
              Don't have an account?<a href="account.html">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>    

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('frontend/js/bootstrap.js')}}"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="{{ asset('frontend/js/jquery.smartmenus.js')}}"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="{{ asset('frontend/js/jquery.smartmenus.bootstrap.js')}}"></script>  
  <!-- To Slider JS -->
  <script src="{{ asset('frontend/js/sequence.js')}}"></script>
  <script src="{{ asset('frontend/js/sequence-theme.modern-slide-in.js')}}"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="{{ asset('frontend/js/jquery.simpleGallery.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontend/js/jquery.simpleLens.js')}}"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="{{ asset('frontend/js/slick.js')}}"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="{{ asset('frontend/js/nouislider.js')}}"></script>
  <!-- Custom js -->
  <script src="{{ asset('frontend/js/custom.js')}}"></script> 
  @stack('scripts')
  </body>
</html>