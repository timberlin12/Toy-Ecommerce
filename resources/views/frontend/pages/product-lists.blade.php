@extends('frontend.layouts.master')

@section('title','Ecommerce Laravel || PRODUCT PAGE')

@section('main-content')
<style>
    .video-wrapper {
        position: relative;
        cursor: pointer;
    }

    .video-center-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 60px;
        color: white;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 10px 20px;
        z-index: 10;
        pointer-events: none;
    }
    .desc-panel p{
        max-height: 200px;
        overflow-y: scroll;
    }
</style>
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="javascript:void(0);">Shop List</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		<form action="{{route('shop.filter')}}" method="POST">
		@csrf
			<!-- Product Style 1 -->
			<section class="product-area shop-sidebar shop-list shop section">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-12">
							<div class="shop-sidebar">
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Categories</h3>
                                    <ul class="categor-list">
										@php
											// $category = new Category();
											$menu=App\Models\Category::getAllParentWithChild();
										@endphp
										@if($menu)
										<li>
											@foreach($menu as $cat_info)
													@if($cat_info->child_cat->count()>0)
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
															<ul>
																@foreach($cat_info->child_cat as $sub_menu)
																	<li><a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">{{$sub_menu->title}}</a></li>
																@endforeach
															</ul>
														</li>
													@else
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
													@endif
											@endforeach
										</li>
										@endif
                                        {{-- @foreach(Helper::productCategoryList('products') as $cat)
                                            @if($cat->is_parent==1)
												<li><a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a></li>
											@endif
                                        @endforeach --}}
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Shop By Price -->
								<div class="single-widget range">
									<h3 class="title">Shop by Price</h3>
									<div class="price-filter">
										<div class="price-filter-inner">
											{{-- <div id="slider-range" data-min="10" data-max="2000" data-currency="%"></div>
												<div class="price_slider_amount">
												<div class="label-input">
													<span>Range:</span>
													<input type="text" id="amount" name="price_range" value='@if(!empty($_GET['price'])) {{$_GET['price']}} @endif' placeholder="Add Your Price"/>
												</div>
											</div> --}}
											@php
												$max=DB::table('products')->max('price');
												// dd($max);
											@endphp
											<div id="slider-range" data-min="0" data-max="{{$max}}"></div>
											<div class="product_filter">
											<button type="submit" class="filter_button">Filter</button>
											<div class="label-input">
												<span>Range:</span>
												<input type="text" id="amount" readonly/>
												<input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
											</div>
											</div>
										</div>
									</div>
									{{-- <ul class="check-box-list">
										<li>
											<label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox">$20 - $50<span class="count">(3)</span></label>
										</li>
										<li>
											<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">$50 - $100<span class="count">(5)</span></label>
										</li>
										<li>
											<label class="checkbox-inline" for="3"><input name="news" id="3" type="checkbox">$100 - $250<span class="count">(8)</span></label>
										</li>
									</ul> --}}
								</div>
								<!--/ End Shop By Price -->
                                <!-- Single Widget -->
                                <div class="single-widget recent-post">
                                    <h3 class="title">Recently Added</h3>
                                    {{-- {{dd($recent_products)}} --}}
                                    @foreach($recent_products as $product)
                                        <!-- Single Post -->
                                        <div class="single-post first">
                                            <div class="image">
                                                <img src="{{$product->images->first()->image_url}}" alt="{{$product->images->first()->image_url}}">
                                            </div>
                                            <div class="content">
                                                <h5><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h5>
                                                @php
                                                    $org=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <p class="price"><del class="text-muted">{{number_format($product->price,2)}}</del> <br>  {{number_format($org,2)}}  </p>                                                
                                            </div>
                                        </div>
                                        <!-- End Single Post -->
                                    @endforeach
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Single Widget -->
                                {{-- <div class="single-widget category">
                                    <h3 class="title">Brands</h3>
                                    <ul class="categor-list">
                                        @php
                                            $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                        @endphp
                                        @foreach($brands as $brand)
                                            <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div> --}}
                                <!--/ End Single Widget -->
                        	</div>
						</div>
						<div class="col-lg-9 col-md-8 col-12">
							<div class="row">
								<div class="col-12">
									<!-- Shop Top -->
									<div class="shop-top">
										<div class="shop-shorter">
											<div class="single-shorter">
												<label>Show :</label>
												<select class="show" name="show" onchange="this.form.submit();">
													<option value="">Default</option>
													<option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>09</option>
													<option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
													<option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
													<option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
												</select>
											</div>
											<div class="single-shorter">
												<label>Sort By :</label>
												<select class='sortBy' name='sortBy' onchange="this.form.submit();">
													<option value="">Default</option>
													<option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Name</option>
													<option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Price</option>
													<option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Category</option>
													<option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Brand</option>
												</select>
											</div>
										</div>
										<ul class="view-mode">
											<li><a href="{{route('product-grids')}}"><i class="fa fa-th-large"></i></a></li>
											<li class="active"><a href="javascript:void(0)"><i class="fa fa-th-list"></i></a></li>
										</ul>
									</div>
									<!--/ End Shop Top -->
								</div>
							</div>
							<div class="row">
								@if(count($products))
									@foreach($products as $product)
									 	{{-- {{$product}} --}}
										<!-- Start Single List -->
										<div class="col-12">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-sm-6">
													<div class="single-product">
														<div class="product-img">
															<div class="button-head">
																<div class="product-action">
																	<a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
																	<a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" class="wishlist" data-id="{{$product->id}}"><i class="{{ in_array($product->id, $wishlistProductIds) ? 'fa fa-heart' : 'ti-heart' }}"></i><span>{{ in_array($product->id, $wishlistProductIds) ? 'Already Added in Wishlist or Cart' : 'Add to Wishlist' }}</span></a>
																</div>
																<div class="product-action-2">
																	<a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
																</div>
															</div>
															<a href="{{route('product-detail',$product->slug)}}">
																@if($product->images->isNotEmpty())
																	<img class="default-img" src="{{$product->images->first()->image_url}}" alt="{{$product->images->first()->image_url}}">
																@else
																	<img class="default-img" src="https://via.placeholder.com/300" alt="Placeholder">
																@endif
																<img class="hover-img" src="{{ $product->images->first()->image_url ?? 'https://via.placeholder.com/600x370' }}" alt="{{ $product->images->first()->image_url ?? 'Placeholder' }}">
															</a>
														</div>
													</div>
												</div>
												<div class="col-lg-8 col-md-6 col-12">
													<div class="list-content">
														<div class="product-content">
															<div class="product-price">
																@php
																	$after_discount=($product->price-($product->price*$product->discount)/100);
																@endphp
																<span>{{number_format($after_discount,2)}}</span>
																<del>{{number_format($product->price,2)}}</del>
															</div>
															<h3 class="title"><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
														{{-- <p>{!! html_entity_decode($product->summary) !!}</p> --}}
														</div>
														<p class="des pt-2">{!! html_entity_decode($product->summary) !!}</p>
														<a href="{{route('add-to-cart',$product->slug)}}" class="btn cart" data-id="{{$product->id}}">Buy Now!</a>
													</div>
												</div>
											</div>
										</div>
										<!-- End Single List -->
									@endforeach
								@else
									<h4 class="text-danger" style="margin:100px auto;">Sorry, there are no products according to the range given. Try selecting different one to see more results.</h4>
								@endif
							</div>
							 <div class="row">
                            <div class="col-md-12 justify-content-center d-flex">
                                {{-- {{$products->appends($_GET)->links()}}  --}}
                            </div>
                          </div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Product Style 1  -->	
		</form>
		<!-- Modal -->
		@if($products)
        @foreach($products as $key=>$product)
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

                                        <!-- Total Price -->
                                        <div class="text-center">
                                            <span id="totalPrice{{$product->id}}" class="h5 font-weight-semibold text-dark">
                                                Total: ₹{{number_format($after_discount, 2)}}
                                            </span>
                                        </div>
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
@push ('styles')
<style>
	 .pagination{
        display:inline-flex;
    }
	.filter_button{
        text-align: center;
        background:#8c52ff;
        padding:8px 16px;
        margin-top:10px;
        color: white;
    }
	.quickview-content{
		padding-bottom: 0px;
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
	<script>
		$('.des').next('p').css({
			'max-height': '150px',
			'overflow-y': 'scroll'
		});

        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }
            
            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })

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
        @foreach($products as $product)
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
        
    </script>
@endpush