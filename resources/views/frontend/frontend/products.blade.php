@extends('layouts.frontend.app')
@section('title', 'Jays Jewellry | Products')
@section('content')
  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="{{ route('product.viewProducts') }}" method="GET" class="aa-sort-form">
                  <label for="sort">Sort by</label>
                  <select name="sort" id="sort">
                    <option value="" selected>Default</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Date</option>
                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                  </select>
                  <label for="order">Order</label>
                  <select name="order" id="order">
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                  </select>
                  <button type="submit">Apply Filters</button>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
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
                          {{-- @if($product->is_featured)
                              <span class="aa-badge aa-sale" href="#">SALE!</span>
                          @endif --}}
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
        </aside>
        </div>
      </div> 
    </div>
  </section>
  <!-- / product category -->
  @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('success') }}");
        });
    </script>
    @endif
@endsection

