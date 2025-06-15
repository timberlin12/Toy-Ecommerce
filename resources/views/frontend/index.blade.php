@extends('frontend.layouts.master')
@section('title','Ecommerce Laravel || HOME PAGE')
@section('main-content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<!-- Slider Area -->
{{-- @if(count($banners)>0)
    <section id="Gslider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
            @endforeach

        </ol>
        <div class="carousel-inner" role="listbox">
                @foreach($banners as $key=>$banner)
                <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                    <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block text-left">
                        <h1 class="wow fadeInDown">{{$banner->title}}</h1>
                        <p>{!! html_entity_decode($banner->description) !!}</p>
                        <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{route('product-grids')}}" role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </section>
@endif --}}
@if(count($banners) > 0)
<!-- slider section -->
<section class="slider_section">
  <div id="customCarousel1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      @foreach($banners as $key => $banner)
      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
                <h1>
                  {{ $banner->title }}
                </h1>
                <p>
                  {!! html_entity_decode($banner->description) !!}
                </p>
                <div class="btn-box">
                  <a href="{{ route('product-grids') }}" class="btn1">
                    Shop Now
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="{{ $banner->photo }}" alt="{{ $banner->title }}">
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <ol class="carousel-indicators">
      @foreach($banners as $key => $banner)
      <li data-target="#customCarousel1" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
      @endforeach
    </ol>
  </div>
</section>
<!-- end slider section -->
@endif
{{-- @dd($product_lists) --}}


<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            @php
            $category_lists = DB::table('categories')
                ->where('status', 'active')
                ->where('is_parent', 1)
                ->limit(3)
                ->get();
            @endphp
            @if($category_lists)
                @foreach($category_lists as $cat)
                    @if($cat->is_parent==1)
                        <!-- Single Banner  -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-banner">
                                @if($cat->photo)
                                    <img src="{{$cat->photo}}" alt="{{$cat->photo}}">
                                @else
                                    <img src="https://via.placeholder.com/600x370" alt="#">
                                @endif
                                <div class="content">
                                    <h3>{{$cat->title}}</h3>
                                        <a href="{{route('product-cat',$cat->slug)}}">Discover Now</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- /End Single Banner  -->
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Small Banner -->

<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>New Items</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                            @php
                                $categories = DB::table('categories')->where('status', 'active')->where('is_parent', 1)->get();
                            @endphp
                            @if($categories)
                                <button class="btn" style="background:black"data-filter="*">
                                    Recently Added
                                </button>
                                    @foreach($categories as $key=>$cat)

                                    <button class="btn" style="background:none;color:black;"data-filter=".{{$cat->id}}">
                                        {{$cat->title}}
                                    </button>
                                    @endforeach
                                @endif
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content isotope-grid" id="myTabContent">
                        @php
                            $recentlyAddedProducts = App\Models\Product::where('status', 'active')
                                ->orderBy('created_at', 'desc')
                                ->take(8)
                                ->with('images') // Eager load the images relationship
                                ->get();
                        @endphp
                        @foreach($recentlyAddedProducts as $key => $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->cat_id}}">
                            <div class="single-product">
                                <div class="product-img">
                                        <div class="button-head">
                                            <div class="product-action">
                                                <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
                                                <a title="Wishlist" href="{{route('add-to-wishlist', $product->slug)}}"><i class="{{ in_array($product->id, $wishlistProductIds) ? 'fa fa-heart' : 'ti-heart' }}"></i><span>{{ in_array($product->id, $wishlistProductIds) ? 'Already Added in Wishlist or Cart' : 'Add to Wishlist' }}</span></a>
                                            </div>
                                            <div class="product-action-2">
                                                <a title="Add to cart" href="{{route('add-to-cart', $product->slug)}}">Add to cart</a>
                                            </div>
                                        </div>
                                    <a href="{{route('product-detail', $product->slug)}}">
                                        @if($product->images->isNotEmpty())
                                            <img class="default-img" src="{{$product->images->first()->image_url}}" alt="{{$product->images->first()->image_url}}">
                                        @else
                                            <img class="default-img" src="https://via.placeholder.com/300" alt="Placeholder">
                                        @endif
                                        <img class="hover-img" src="{{ $product->images->first()->image_url ?? 'https://via.placeholder.com/600x370' }}" alt="{{ $product->images->first()->image_url ?? 'Placeholder' }}">
                                        @if($product->stock <= 0)
                                            <span class="out-of-stock">Sold Out</span>
                                        @elseif($product->condition == 'new')
                                            <span class="new">New</span>
                                        @elseif($product->condition == 'hot')
                                            <span class="hot">Hot</span>
                                        @else
                                            <span class="price-dec">{{$product->discount}}% Off</span>
                                        @endif
                                    </a>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product-detail', $product->slug)}}">{{$product->title}}</a></h3>
                                        @php
                                            $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                                        @endphp
                                        <div class="product-price">
                                            <span>{{number_format($after_discount, 2)}}</span>
                                            <del style="padding-left: 4%;">{{number_format($product->price, 2)}}</del>
                                        </div>
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
<!-- End Product Area -->
{{-- @php
    $featured=DB::table('products')->where('is_featured',1)->where('status','active')->orderBy('id','DESC')->limit(1)->get();
@endphp --}}
<!-- Start Midium Banner  -->
<section class="midium-banner">
    <div class="container">
        <div class="row">
            @if($featured)
                @foreach($featured as $data)
                    <!-- Single Banner -->
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="single-banner">
                            <img src="{{ $data->images->first()->image_url ?? 'https://via.placeholder.com/600x370' }}" alt="{{ $data->images->first()->image_url ?? 'Placeholder' }}">
                            <div class="content">
                                <p>{{ $data->cat_info['title'] }}</p>
                                <h3>{{ $data->title }} <br>Up to<span> {{ $data->discount }}%</span></h3>
                                <a href="{{ route('product-detail', $data->slug) }}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- /End Single Banner -->
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Midium Banner -->

<!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)
                        @if($product->condition == 'hot')
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-img">
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="{{route('add-to-wishlist', $product->slug)}}"><i class="{{ in_array($product->id, $wishlistProductIds) ? 'fa fa-heart' : 'ti-heart' }}"></i><span>{{ in_array($product->id, $wishlistProductIds) ? 'Already Added in Wishlist or Cart' : 'Add to Wishlist' }}</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a href="{{route('add-to-cart', $product->slug)}}">Add to cart</a>
                                        </div>
                                    </div>
                                    <a href="{{route('product-detail', $product->slug)}}">
                                        @if($product->images->isNotEmpty())
                                            <img class="default-img" src="{{$product->images->first()->image_url}}" alt="{{$product->images->first()->image_url}}">
                                        @else
                                            <img class="default-img" src="https://via.placeholder.com/300" alt="Placeholder">
                                        @endif
                                        <img class="hover-img" src="{{ $product->images->first()->image_url ?? 'https://via.placeholder.com/600x370' }}" alt="{{ $product->images->first()->image_url ?? 'Placeholder' }}">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('product-detail', $product->slug)}}">{{$product->title}}</a></h3>
                                    <div class="product-price">
                                        <span class="old">{{number_format($product->price, 2)}}</span>
                                        @php
                                            $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                                        @endphp
                                        <span>{{number_format($after_discount, 2)}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->

<!-- Start Shop Home List  -->
<section class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Latest Items</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $product_lists = App\Models\Product::where('status', 'active')->orderBy('id', 'DESC')->limit(6)->get();
                    @endphp
                    @foreach($product_lists as $product)
                        <div class="col-md-4">
                            <!-- Start Single List -->
                            <div class="single-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="list-image overlay">
                                             @if($product->images->isNotEmpty())
                                                <img src="{{$product->images->first()->image_url}}" alt="{{$product->images->first()->image_url}}">
                                            @else
                                                <img  src="https://via.placeholder.com/300" alt="Placeholder">
                                            @endif
                                            <a href="{{route('add-to-cart', $product->slug)}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 no-padding">
                                        <div class="content">
                                            <h4 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->title}}</a></h4>
                                            <p class="price with-discount">{{number_format($product->discount, 2)}}% OFF</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single List -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->

<!-- Start Shop Blog  -->
{{-- <section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>From Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if($posts)
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Blog  -->
                        <div class="shop-single-blog">
                            <img src="{{$post->photo}}" alt="{{$post->photo}}">
                            <div class="content">
                                <p class="date">{{$post->created_at->format('d M , Y. D')}}</p>
                                <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continue Reading</a>
                            </div>
                        </div>
                        <!-- End Single Blog  -->
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section> --}}
<!-- End Shop Blog  -->

<!-- Start Shop Services Area -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over 40</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>No Return</h4>
                    <p>No return Policy</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services Area -->

{{-- @include('frontend.layouts.newsletter') --}}

<!-- Modal -->
@if($product_lists)
        @foreach($product_lists as $key=>$product)
            <div id="{{$product->id}}" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog modal-xl" role="document" style="max-width: 90%; margin: 2rem auto;">
                    <div class="modal-content" style="border-radius: 5px; overflow: hidden;">
                        <div class="modal-body p-0" style="max-height: none;">
                            <div class="row no-gutters" style="min-height: 600px;">
                                
                                <!-- Image Section -->
                                <div class="col-lg-6 col-md-12" style="background: #f8f9fa; position: relative; min-height: 400px;">
                                    
                                    <!-- Main Image Container -->
                                    <div class="position-relative" style="height: 70%; min-height: 300px; padding: 1rem;">
                                        @php $currentImages = $product->images->toArray(); @endphp
                                        @if(!empty($currentImages))
                                            <img id="mainImage{{$product->id}}" 
                                                 src="{{$currentImages[0]['image_url']}}" 
                                                 alt="{{$product->title}}" 
                                                 class="w-100 h-100" 
                                                 style="object-fit: contain; background: white; border-radius: 8px;">

                                            @if(count($currentImages) > 1)
                                                <!-- Navigation Arrows -->
                                                <button onclick="prevImage({{$product->id}})" class="btn position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.95); border: 2px solid #dee2e6; border-radius: 50%; width: 45px; height: 45px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.15); z-index: 10;">
                                                    <i class="fa fa-chevron-left" style="font-size: 14px; color: #495057;"></i>
                                                </button>
                                                <button onclick="nextImage({{ $product->id }})" class="btn position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.95); border: 2px solid #dee2e6; border-radius: 50%; width: 45px; height: 45px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.15); z-index: 10;">
                                                    <i class="fa fa-chevron-right" style="font-size: 14px; color: #495057;"></i>
                                                </button>

                                                <!-- Image Indicators -->
                                                <div class="position-absolute d-flex justify-content-center" style="bottom: 15px; left: 50%; transform: translateX(-50%);" id="imageIndicators{{$product->id}}">
                                                    @foreach($currentImages as $index => $image)
                                                        <button onclick="setCurrentImage({{$product->id}}, {{$index}})" 
                                                                class="btn p-0 mx-1" 
                                                                style="width: 10px; height: 10px; border-radius: 50%; background: {{$index === 0 ? '#007bff' : 'rgba(255,255,255,0.7)'}}; border: none; transition: all 0.3s ease;">
                                                        </button>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endif

                                        @if($product->video_url)
                                            <div class="video-wrapper position-absolute" style="top: 0; left: 0; width: 100%; height: 100%;">
                                                <video id="customVideo{{$product->id}}" autoplay loop muted playsinline class="w-100 h-100" style="object-fit: contain;">
                                                    <source src="{{ $product->video_url }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <div id="videoOverlayIcon{{$product->id}}" class="video-center-icon" style="display: none;">❚❚</div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Thumbnail Strip -->
                                    @if(!empty($currentImages) && count($currentImages) > 1)
                                        <div class="p-3" style="height: 30%;">
                                            <div class="d-flex justify-content-center" style="overflow-x: auto; gap: 8px; height: 100%;" id="thumbnailStrip{{$product->id}}">
                                                @foreach($currentImages as $index => $image)
                                                    <button onclick="setCurrentImage({{$product->id}}, {{$index}})" 
                                                            class="btn p-0 flex-shrink-0" 
                                                            style="width: 80px; height: 80px; border: 3px solid {{$index === 0 ? '#007bff' : 'transparent'}}; border-radius: 8px; overflow: hidden; transition: all 0.3s ease;">
                                                        <img src="{{$image['image_url']}}" 
                                                             alt="Thumbnail {{$index + 1}}" 
                                                             class="w-100 h-100" 
                                                             style="object-fit: cover;">
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details Section -->
                                <div class="col-lg-6 col-md-12 p-4 d-flex flex-column" style="min-height: 600px;">
                                    <div class="flex-grow-1" style="overflow-y: auto;">
                                        <!-- Product Header -->
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge badge-secondary px-3 py-1" style="font-size: 0.75rem;">{{$product->category ?? 'Electronics'}}</span>
                                                <!-- Close Button -->
                                                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="top: 15px; right: 15px; z-index: 20; background: rgba(255,255,255,0.9); border: none; border-radius: 50%; width: 40px; height: 40px; padding: 0; font-size: 20px;">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <h2 class="h3 font-weight-bold mb-3">{{$product->title}}</h2>
                                            
                                            <!-- Rating -->
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $rate = DB::table('product_reviews')->where('product_id',$product->id)->avg('rate') ?? 0;
                                                        $rate_count = DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate >= $i)
                                                            <i class="fa fa-star text-warning" style="font-size: 14px;"></i>
                                                        @else
                                                            <i class="fa fa-star text-muted" style="font-size: 14px;"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="ml-2 text-muted small">{{number_format($rate, 1)}} ({{$rate_count}} reviews)</span>
                                            </div>

                                            <!-- Price -->
                                            @php
                                                $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                                            @endphp
                                            <div class="d-flex align-items-center mb-4">
                                                <span class="h3 font-weight-bold mb-0 text-primary">₹{{number_format($after_discount, 2)}}</span>
                                                @if($product->discount)
                                                    <span class="text-muted ml-3" style="text-decoration: line-through; font-size: 1.1rem;">₹{{number_format($product->price, 2)}}</span>
                                                    <span class="badge badge-success ml-2 px-2 py-1">Save ₹{{number_format($product->price - $after_discount, 2)}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-4 desc-panel">
                                            <h5 class="font-weight-semibold mb-2">Description</h5>
                                            <span class="text-muted" style="line-height: 1.6; font-size: 0.9rem;">{!! html_entity_decode($product->summary) !!}</span>
                                        </div>

                                        <!-- Stock Status -->
                                        <div class="mb-4">
                                            @if($product->stock > 0)
                                                <span class="badge badge-success px-3 py-2">
                                                    <i class="fa fa-check-circle mr-1"></i>{{$product->stock}} in stock
                                                </span>
                                            @else
                                                <span class="badge badge-danger px-3 py-2">
                                                    <i class="fa fa-times-circle mr-1"></i>Out of stock
                                                </span>
                                            @endif
                                        </div>
                                        <br>
                                        <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" class="wishlist" data-id="{{$product->id}}"><i class="{{ in_array($product->id, $wishlistProductIds) ? 'fa fa-heart' : 'ti-heart' }}"></i><span>{{ in_array($product->id, $wishlistProductIds) ? 'Already Added in Wishlist or Cart' : 'Add to Wishlist' }}</span></a>
                                    </div>

                                    <!-- Add to Cart Section -->
                                    <div class="border-top pt-4 mt-4">
                                        <form action="{{route('single-add-to-cart')}}" method="POST">
                                            @csrf
                                            <!-- Quantity Selector -->
                                            <div class="d-flex align-items-center mb-4">
                                                <label class="font-weight-medium mr-3" style="min-width: 70px; font-size: 0.9rem;">Quantity:</label>
                                                <div class="d-flex align-items-center border rounded" style="background: #f8f9fa;">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="minus" data-field="quant{{$product->id}}" style="border: none; background: #312f2fe6; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fa fa-minus" style="font-size: 12px;"></i>
                                                    </button>
                                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                                    <input type="text" name="quant[1]" id="quant{{$product->id}}" class="form-control input-number text-center border-0" data-min="1" data-max="1000" value="1" style="width: 60px; background: transparent; font-weight: 500;">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="plus" data-field="quant{{$product->id}}" style="border: none; background: #312f2fe6; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fa fa-plus" style="font-size: 12px;"></i>
                                                    </button>
                                                </div>
                                                <!-- Total Price -->
                                                <div class="text-right ml-5">
                                                    <span id="totalPrice{{$product->id}}" class="h5 font-weight-semibold text-dark">
                                                        Total: ₹{{number_format($after_discount, 2)}}
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Add to Cart Button -->
                                            <button type="submit" 
                                                    class="btn btn-primary btn-lg btn-block d-flex align-items-center justify-content-center mb-3" 
                                                    style="height: 50px; font-weight: 600;"
                                                    {{$product->stock <= 0 ? 'disabled' : ''}}>
                                                <i class="fa fa-shopping-cart mr-2"></i>
                                                <span>{{$product->stock > 0 ? 'Add to Cart' : 'Out of Stock'}}</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Product-specific data for product {{$product->id}}
                window.productData{{$product->id}} = {
                    id: {{$product->id}},
                    name: "{{$product->title}}",
                    price: {{$after_discount}},
                    images: {!! json_encode($currentImages) !!}
                };
            </script>
        @endforeach
    @endif
<!-- Modal end -->
@endsection

@push('styles')
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
        background: #000000;
        color:black;
        }

        #Gslider .carousel-inner{
        height: 550px;
        }
        #Gslider .carousel-inner img{
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        /* color: #F7941D; */
        color: #1e1e1e;
        }

        #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
        bottom: 70px;
        }
        .desc-panel p{
            max-height: 200px;
            overflow-y: scroll;
        }
    
        /* Modal responsive styles */
        @media (max-width: 992px) {
            .modal-xl {
                max-width: 95% !important;
                margin: 1rem auto !important;
            }
            
            .modal-content {
                min-height: 500px !important;
            }
            
            .row.no-gutters {
                min-height: 500px !important;
            }
            
            .col-lg-6:first-child {
                min-height: 300px !important;
            }
        }
        
        @media (max-width: 768px) {
            .modal-xl {
                max-width: 98% !important;
                margin: 0.5rem auto !important;
            }
            
            .modal-content {
                min-height: auto !important;
            }
            
            .col-lg-6:first-child {
                min-height: 250px !important;
            }
            
            .p-4 {
                padding: 1rem !important;
            }
            
            .d-flex.align-items-center.mb-4 {
                flex-direction: column;
                align-items: stretch !important;
            }
            
            .d-flex.align-items-center.mb-4 label {
                margin-bottom: 0.5rem;
                text-align: center;
            }
        }
        
        @media (max-width: 576px) {
            .modal-xl {
                max-width: 100% !important;
                margin: 0 !important;
            }
            
            .modal-content {
                border-radius: 0 !important;
                min-height: 100vh !important;
            }
            
            .row.no-gutters {
                min-height: 100vh !important;
            }
        }

        /* Custom button hover effects */
        .btn:hover {
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        /* Thumbnail hover effects */
        #thumbnailStrip{{$product->id ?? '1'}} button:hover {
            border-color: #007bff !important;
            transform: scale(1.05);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine: 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');
        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }
                $(this).addClass('how-active1');
            });
        });

        function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen;
            if (requestMethod) {
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") {
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;
            if (requestMethod) {
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") {
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false;
        }
        

        // Quantity button handlers
        $(document).on('click', '.btn-number', function(e){
            e.preventDefault();
            
            var fieldName = $(this).attr('data-field');
            var type = $(this).attr('data-type');
            var input = $("input[name='quant[1]']", $(this).closest('form'));
            var currentVal = parseInt(input.val());
            
            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    if(currentVal > input.attr('data-min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == input.attr('data-min')) {
                        $(this).attr('disabled', true);
                    }
                } else if(type == 'plus') {
                    if(currentVal < input.attr('data-max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('data-max')) {
                        $(this).attr('disabled', true);
                    }
                }
            } else {
                input.val(1);
            }
        });

        // Update total price when quantity changes
        $('.input-number').on('change keyup', function() {
            var productId = $(this).attr('id').replace('quant', '');
            var quantity = parseInt($(this).val()) || 1;
            var productData = window['productData' + productId];
            
            if (productData) {
                var total = (productData.price * quantity).toFixed(2);
                $('#totalPrice' + productId).text('Total: $' + total);
            }
        });

    // Image slider functions for each product
    let currentImageIndexes = {};

    function nextImage(productId) {
        var productData = window['productData' + productId];
        if (!productData || !productData.images || productData.images.length <= 1) return;
        
        if (!currentImageIndexes[productId]) currentImageIndexes[productId] = 0;
        
        currentImageIndexes[productId] = (currentImageIndexes[productId] + 1) % productData.images.length;
        updateMainImage(productId);
        updateIndicators(productId);
        updateThumbnails(productId);
    }

    function prevImage(productId) {
        var productData = window['productData' + productId];
        if (!productData || !productData.images || productData.images.length <= 1) return;
        
        if (!currentImageIndexes[productId]) currentImageIndexes[productId] = 0;
        
        currentImageIndexes[productId] = (currentImageIndexes[productId] - 1 + productData.images.length) % productData.images.length;
        updateMainImage(productId);
        updateIndicators(productId);
        updateThumbnails(productId);
    }

    function setCurrentImage(productId, index) {
        var productData = window['productData' + productId];
        if (!productData || !productData.images || index >= productData.images.length) return;
        
        currentImageIndexes[productId] = index;
        updateMainImage(productId);
        updateIndicators(productId);
        updateThumbnails(productId);
    }

    function updateMainImage(productId) {
        var productData = window['productData' + productId];
        if (!productData || !productData.images) return;
        
        var currentIndex = currentImageIndexes[productId] || 0;
        var mainImage = document.getElementById('mainImage' + productId);
        if (mainImage && productData.images[currentIndex]) {
            mainImage.src = productData.images[currentIndex].image_url;
        }
    }

    function updateIndicators(productId) {
        var productData = window['productData' + productId];
        if (!productData || !productData.images) return;
        
        var currentIndex = currentImageIndexes[productId] || 0;
        var indicators = document.getElementById('imageIndicators' + productId);
        if (indicators) {
            var buttons = indicators.querySelectorAll('button');
            buttons.forEach(function(button, index) {
                button.style.background = index === currentIndex ? '#007bff' : 'rgba(255,255,255,0.7)';
            });
        }
    }

    function updateThumbnails(productId) {
        var productData = window['productData' + productId];
        if (!productData || !productData.images) return;
        
        var currentIndex = currentImageIndexes[productId] || 0;
        var thumbnailStrip = document.getElementById('thumbnailStrip' + productId);
        if (thumbnailStrip) {
            var buttons = thumbnailStrip.querySelectorAll('button');
            buttons.forEach(function(button, index) {
                button.style.borderColor = index === currentIndex ? '#007bff' : 'transparent';
            });
        }
    }

    // Wishlist toggle function
    function toggleWishlist(productId) {
        var wishlistBtn = document.getElementById('wishlistBtn' + productId);
        var icon = wishlistBtn.querySelector('i');
        
        if (icon.classList.contains('fa-heart-o')) {
            icon.className = 'fa fa-heart text-danger';
        } else {
            icon.className = 'fa fa-heart-o';
        }
    }

    // Video controls
    document.addEventListener("DOMContentLoaded", function () {
        @foreach($product_lists as $product)
            @if($product->video_url)
                (function(productId) {
                    const video = document.getElementById("customVideo" + productId);
                    const overlay = document.getElementById("videoOverlayIcon" + productId);
                    const container = video?.parentElement;

                    if (container && video && overlay) {
                        container.addEventListener("click", function () {
                            if (video.paused) {
                                video.play();
                                showIcon("▶", overlay);
                            } else {
                                video.pause();
                                showIcon("❚❚", overlay);
                            }
                        });
                    }
                })({{$product->id}});
            @endif
        @endforeach

        function showIcon(symbol, overlay) {
            if (overlay) {
                overlay.innerHTML = symbol;
                overlay.style.display = "block";
                setTimeout(() => {
                    overlay.style.display = "none";
                }, 500);
            }
        }
    });

        // $(document).ready(function() {
		// 	$('.modal').on('show.bs.modal', function () {
		// 		var $slider = $(this).find('.quickview-slider-active');

		// 		// Remove all owl-related classes
		// 		$slider.removeClass('owl-carousel owl-theme owl-loaded owl-loading');

		// 		// Remove owl internal structure and unwrap images
		// 		$slider.find('.owl-stage-outer, .owl-stage, .owl-item, .owl-wrapper-outer, .owl-wrapper').each(function(){
		// 			$(this).replaceWith($(this).html());
		// 		});
		// 	});
		// 	$('.owl-item.cloned').hide();
		// });
    </script>

@endpush
