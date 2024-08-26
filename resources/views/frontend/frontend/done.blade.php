@extends('layouts.frontend.app')
@section('title', 'Jays Jewellry | Order Placed')
@section('content')
  <section id="aa-error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-error-area">
            <h2><i class="fa fa-check-circle" aria-hidden="true"></i></h2>
            <span>Order placed successfully!</span>
            <p>Shop More!</p>
            <a href="{{ route('home') }}"> Go to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.success("{{ session('success') }}");
    });
</script>
@endif
  <br>
  @endsection


