@extends('layouts.frontend.app')
@section('title', 'Jays Jewellry | Empty Cart')
@section('content')
  <!-- 404 error section -->
  <section id="aa-error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-error-area">
            <h2>SHOP NOW</h2>
            <span>Sorry! Your cart is empty</span>
            <p>Please add items to the cart to proceed checkout!</p>
            <a href="{{ route('home') }}"> Go to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br>
  <!-- / 404 error section -->
  @endsection