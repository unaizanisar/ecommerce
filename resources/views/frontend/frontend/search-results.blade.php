@extends('layouts.frontend.app')
@section('title', 'Search Results')
@section('content')

<section id="aa-product-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="aa-product-catg-content">
                    <div class="aa-product-catg-head">
                        <h2>Search Results for: "{{ $query }}"</h2>
                    </div>
                    <div class="aa-product-catg-body">
                        @if($products->isEmpty())
                            <p>No products found.</p>
                        @else
                            <ul class="aa-product-catg">
                                @foreach($products as $product)
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="{{ route('product.show', $product->id) }}">
                                                <img src="{{ asset('uploads/products/' . $product->images) }}" alt="{{ $product->name }}" class="product-image">
                                            </a>
                                            <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                              @csrf
                                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                                              <input type="hidden" name="quantity" value="1">
                                              <button type="submit" class="aa-add-card-btn">
                                                  <span class="fa fa-shopping-cart"></span>Add To Cart
                                              </button>
                                          </form>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h4>
                                                <span class="aa-product-price">Rs. {{ $product->price }}</span>
                                                <p class="aa-product-descrip">{{ $product->description }}</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Pagination -->
                            <div class="aa-product-catg-pagination">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
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
@endsection
