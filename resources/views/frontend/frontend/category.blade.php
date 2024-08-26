@extends('layouts.frontend.app')
@section('title', 'Jays Jewellry | ' . $category->name)
@section('content')

<!-- category products -->
<section id="aa-product-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                <div class="aa-product-catg-content">
                    <div class="aa-product-catg-head">
                        <h2>{{ $category->name }}</h2>
                    </div>
                    <div class="aa-product-catg-body">
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
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                <aside class="aa-sidebar">
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Category</h3>
                        <ul class="aa-catg-nav">
                            @foreach($categories as $cat)
                                <li><a href="{{ route('category.view', $cat->id) }}">{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- single sidebar -->
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- / category products -->

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('success') }}");
        });
    </script>
@endif
@endsection
