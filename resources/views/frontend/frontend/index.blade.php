@extends('layouts.frontend.app')
@section('title', 'Jays Jewellry | Home')
@section('content')
  <!-- / header section -->
  <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas"> 
            <!-- Loop through the banners -->
            @foreach($banners as $banner)
            <li>
              <div class="seq-model">
                <img data-seq src="{{ asset('uploads/banner/'. $banner->image) }}" alt="Banner slide img" />
              </div>
              <div class="seq-title">
               {{-- <span data-seq>{{ $banner-> }}</span>                 --}}
                <h2 data-seq>{{ $banner->description }}</h2>                
                <p data-seq>{{ $banner->description }}</p>
                <a data-seq href="{{ $banner->btn_link }}" class="aa-shop-now-btn aa-secondary-btn">{{ $banner->btn_text }}</a>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo left -->
              <!-- promo right -->
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">
                  @foreach($home_categories as $list)
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{ asset('uploads/category/'. $list->image) }}" alt="img">                      
                      <div class="aa-prom-content">
                        <span>Exclusive Item</span>
                        <h4><a href="{{ url('category/'. $list->name) }}">{{ $list->name }}</a></h4>                        
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
<section id="aa-product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-product-area">
            <div class="aa-product-inner">
              <!-- start prduct navigation -->
              <ul class="nav nav-tabs aa-products-tab">
                @foreach($home_categories as $list)
                  <li class=""><a href="#{{ $list->id }}" data-toggle="tab">{{ $list->name }}</a></li>
                @endforeach
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                @php
                  $count = 1;  
                @endphp
                @foreach($home_categories as $list)
                @php
                $cat_class = "";
                if($count == 1){
                  $cat_class = "in active";
                  $count++;
                }
                @endphp
                  <div class="tab-pane fade {{ $cat_class }}" id="{{ $list->id }}">
                    <ul class="aa-product-catg">
                      <!-- start single product item -->
                      @if(isset($home_categories_product[$list->id][0]))
                        @foreach($home_categories_product[$list->id] as $product)
                          <li>
                            <figure>
                              <!-- Link to product details -->
                              <a class="aa-product-img" href="{{ route('product.show', ['id' => $product->id]) }}">
                                <img src="{{ asset('uploads/products/'. $product->images) }}" alt="product img" class="product-image">
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
                                <h4 class="aa-product-title"><a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->name }}</a></h4>
                                <span class="aa-product-price">Rs. {{ $product->price }}</span>
                              </figcaption>
                            </figure>                        
                          </li> 
                        @endforeach                  
                      @else 
                        <li>
                          <figure>
                            No Data Found
                          </figure>
                        </li>
                      @endif 
                    </ul>
                  </div>
                @endforeach    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="text-align: center; margin-top: 20px;">
    <a class="aa-browse-btn" href="{{ route('product.viewProducts') }}">Browse all Products <span class="fa fa-long-arrow-right"></span></a>
  </div>
  <br>
</section>
<!-- / Products section -->

  <!-- featured section -->
  
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
                                              <div class="aa-product-catg-body">
                                                <ul class="aa-product-catg">
                                                    <li>
                                                        <figure>
                                                            <a class="aa-product-img" href="#">
                                                                <img src="{{ asset('uploads/products/'. $product->images) }}" alt="product img" class="product-image">
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
                                                                <h4 class="aa-product-title"><a href="#">{{ $product->name }}</a></h4>
                                                                <span class="aa-product-price">Rs. {{ $product->price }}</span>
                                                            </figcaption>
                                                        </figure>
                                                    </li>
                                                </ul>
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
    <div style="text-align: center; margin-top: 20px;">
      <a class="aa-browse-btn" href="{{ route('product.viewProducts') }}">Browse all Products <span class="fa fa-long-arrow-right"></span></a>
    </div>
    <br>
</section>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.success("{{ session('success') }}");
    });
</script>
@endif
  <!-- / featured section -->
  @endsection
  