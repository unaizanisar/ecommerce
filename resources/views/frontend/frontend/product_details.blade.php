@extends('layouts.frontend.app')
@section('title', 'Jays Jewellry | Product Details')
@section('content')
  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <a data-lens-image="{{ asset('uploads/products/' . $product->images) }}" class="simpleLens-lens-image">
                            <img src="{{ asset('uploads/products/' . $product->images) }}" class="simpleLens-big-image">
                          </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{ $product->name }}</h3>
                    <div class="aa-price-block">
                        <span class="aa-product-view-price">Rs. {{ $product->price }}</span>
                        <p class="aa-product-avilability">Availability: <span>{{ $product->stock > 0 ? 'In stock' : 'Out of stock' }}</span></p>
                    </div>
                      <p>{{ $product->description }}</p>
                      <p class="aa-prod-category">
                        Category: <a href="#">{{ $product->category_id }}</a>
                      </p>
                    </div>
                    
                    
                    <div class="aa-prod-view-bottom">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="aa-add-to-cart-btn">Add To Cart</button>
                        </form>
                    </div>
                  </div>
                
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p>{{ $product->description }}</p>
                  <ul>
                    <li>100% pure</li>
                    <li>Gold Plated</li>
                  </ul>
                </div>
<!--REVIEWS-->
<div class="tab-pane fade" id="review">
    <div class="aa-product-review-area">
        <h4>{{ $reviews->total() }} Reviews</h4>
        <ul class="aa-review-nav">
            @foreach ($reviews as $review)
                <li>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="img/testimonial-img-3.jpg" alt="reviewer image">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <strong>{{ $review->name }}</strong> - 
                                <span>{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}</span>
                            </h4>
                            <div class="aa-product-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="fa {{ $i <= $review->rating ? 'fa-star' : 'fa-star-o' }}"></span>
                                @endfor
                            </div>
                            <p>{{ $review->comment }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        
        <!-- Pagination Links -->
        {{ $reviews->links() }}

        <h4>Add a review</h4>
        <form action="{{ route('product.storeReview', $product->id) }}" method="POST" class="aa-review-form">
            @csrf
            <div class="form-group">
                <label for="message">Your Review</label>
                <textarea class="form-control" rows="3" id="message" name="comment"></textarea>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>  
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
            </div>
            <div class="form-group">
                <label for="rating">Rating</label>
                <select id="rating" name="rating" class="form-control">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
        </form>
    </div>
</div>
<!--END REVIEWS-->
<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            <h2 style="text-align: center">Featured Products</h2>
                            <!-- start product carousel -->
                            @if(isset($featured_products[0]))
                            <div id="featuredCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    @foreach($featured_products->chunk(4) as $key => $chunk)
                                    <li data-target="#featuredCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    @foreach($featured_products->chunk(4) as $key => $chunk)
                                    <div class="item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="row">
                                            @foreach($chunk as $product)
                                            <div class="col-sm-3">
                                                <div class="aa-product-catg">
                                                    <li>
                                                        <figure>
                                                            <a class="aa-product-img" href="#">
                                                                <img src="{{ asset('uploads/products/'. $product->images) }}" alt="product img" class="product-image">
                                                            </a>
                                                            <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                            <figcaption>
                                                                <h4 class="aa-product-title"><a href="#">{{ $product->name }}</a></h4>
                                                                <span class="aa-product-price">Rs. {{ $product->price }}</span>
                                                            </figcaption>
                                                        </figure>
                                                    </li>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#featuredCarousel" role="button" data-slide="prev">
                                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#featuredCarousel" role="button" data-slide="next">
                                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            @else
                            <div>No Featured Products Found</div>
                            @endif
                            <!-- / product carousel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
  <!-- / product category -->
  @endsection