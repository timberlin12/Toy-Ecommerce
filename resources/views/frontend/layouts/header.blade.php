<header class="header shop">
    <!-- Topbar -->
    {{-- <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12"> --}}
    <!-- Top Left -->
    {{-- <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                                
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
    <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
    </ul>
    </div> --}}
    <!--/ End Top Left -->
    {{-- </div>
                <div class="col-lg-6 col-md-12 col-12"> --}}
    <!-- Top Right -->
    {{-- <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
                            @auth 
                                @if(Auth::user()->role=='admin')
                                <li><i class="fa fa-truck"></i> <a href="{{route('order.track')}}">Track Order</a></li>

    <li><i class="ti-user"></i> <a href="{{route('admin')}}" target="_blank">Dashboard</a></li>
    @else
    <li><i class="fa fa-truck"></i> <a href="{{route('order.track')}}">Track Order</a></li>

    <li><i class="ti-user"></i> <a href="{{route('user')}}" target="_blank">Dashboard</a></li>
    @endif
    <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Logout</a></li>

    @else
    <li><i class="fa fa-sign-in"></i><a href="{{route('login.form')}}">Login /</a> <a href="{{route('register.form')}}">Register</a></li>
    @endauth
    </ul>
    </div> --}}
    {{-- <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Topbar -->
    {{-- <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12"> --}}
    <!-- Logo -->
    {{-- <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo"></a>
    </div> --}}
    <!--/ End Logo -->
    <!-- Search Form -->
    {{-- <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div> --}}
    <!-- Search Form -->
    {{-- <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div> --}}
    <!--/ End Search Form -->
    {{-- </div> --}}
    <!--/ End Search Form -->
    {{-- <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option >All Category</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
    @endforeach
    </select>
    <form method="POST" action="{{route('product.search')}}">
        @csrf
        <input name="search" placeholder="Search Products Here....." type="search">
        <button class="btnn" type="submit"><i class="ti-search"></i></button>
    </form>
    </div>
    </div>
    </div>
    <div class="col-lg-2 col-md-3 col-12"> --}}
        {{-- <div class="right-bar"> --}}
        <!-- Search Form -->
        {{-- <div class="sinlge-bar shopping">
                            @php 
                                $total_prod=0;
                                $total_amount=0;
                            @endphp
                           @if(session('wishlist'))
                                @foreach(session('wishlist') as $wishlist_items)
                                    @php
                                        $total_prod+=$wishlist_items['quantity'];
                                        $total_amount+=$wishlist_items['amount'];
                                    @endphp
                                @endforeach
                           @endif
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a> --}}
        <!-- Shopping Item -->
        {{-- @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromWishlist())}} Items</span>
        <a href="{{route('wishlist')}}">View Wishlist</a>
    </div>
    <ul class="shopping-list"> --}}
        {{-- {{Helper::getAllProductFromCart()}} --}}
        {{-- @foreach(Helper::getAllProductFromWishlist() as $data)
                                                    @php
                                                        $photo=explode(',',$data->product['photo']);
                                                    @endphp
                                                    <li>
                                                        <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                        <p class="quantity">{{$data->quantity}} x - <span class="amount">{{number_format($data->price,2)}}</span></p>
                                                    </li>
                                            @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">{{number_format(Helper::totalWishlistPrice(),2)}}</span>
                                        </div>
                                        <a href="{{route('cart')}}" class="btn animate">Cart</a>
                                    </div>
                                </div>
                            @endauth --}}
                            <!--/ End Shopping Item -->
                        {{-- </div> --}}
                        {{-- <div class="sinlge-bar">
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
    </div> --}}
    {{-- <div class="sinlge-bar shopping">
                            <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a> --}}
    <!-- Shopping Item -->
    {{-- @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromCart())}} Items</span>
    <a href="{{route('cart')}}">View Cart</a>
    </div>
    <ul class="shopping-list"> --}}
        {{-- {{Helper::getAllProductFromCart()}} --}}
        {{-- @foreach(Helper::getAllProductFromCart() as $data)
                                                    @php
                                                        $photo=explode(',',$data->product['photo']);
                                                    @endphp
                                                    <li>
                                                        <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                        <p class="quantity">{{$data->quantity}} x - <span class="amount">{{number_format($data->price,2)}}</span></p>
                                                    </li>
                                            @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">{{number_format(Helper::totalCartPrice(),2)}}</span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                            @endauth --}}
                            <!--/ End Shopping Item -->
                        {{-- </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Header Inner -->
    <div class="header-inner">

        <div class="sec-header">
            <button style="background: none; border: none;" id="menu-toggle">
                <i class="fas fa-bars" style="font-size: 30px; cursor: pointer; color: black;border: 2px solid black; padding: 5px; border-radius: 15%;"></i>
            </button>

            @php $settings = DB::table('settings')->get(); @endphp
            <div style="width: 100%; display: flex; justify-content: center;">
                <a href="{{ route('home') }}" class="white-image" style="padding: 0px;">
                    <img src="@foreach($settings as $data) {{ $data->logo }} @endforeach" alt="logo" style="height: 70px;">
                </a>
                <a href="{{ route('home') }}" class="blue-image" style="padding: 0px; display: none;">
                    <img src="http://127.0.0.1:8000/storage/photos/2/logohd2.png" alt="logo" style="height: 50px;">
                </a>
            </div>
        </div>



        <div class="container side-header" style="padding-top: 0px;">
            
        </div>

        <div class="container one-header">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav" style="justify-content: center;">
                                            @php
                                            $settings=DB::table('settings')->get();
                                            @endphp
                                            <li style="width: 20%;">
                                                <a href="{{route('home')}}" style="padding-top: 10px;padding-bottom: 6px;" class="white-image"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo"></a>
                                                <a href="{{route('home')}}" style="padding-top: 15px;padding-bottom: 15px; display:none;" class="blue-image"><img src="http://127.0.0.1:8000/storage/photos/2/logohd2.png" alt="logo"></a>
                                            </li>
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
                                            {{-- <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">About Us</a></li> --}}
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Products</a><span class="new">New</span></li>
                                            {{Helper::getHeaderCategory()}}
                                            {{-- <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li> --}}

                                            {{-- <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li> --}}
                                            @auth
                                            @if(Auth::user()->role=='admin')
                                            <li>
                                                <a href="javascript:void(0);">My Account<i class="ti-angle-down"></i></a>
                                                <ul class="dropdown border-0 shadow">
                                                    <li> <a href="{{route('admin')}}" target="_blank">Dashboard</a></li>
                                                    <li> <a href="{{route('order.track')}}">Track Order</a></li>
                                                </ul>
                                            </li>
                                            @else
                                            <li>
                                                <a href="javascript:void(0);">My Account<i class="ti-angle-down"></i></a>
                                                <ul class="dropdown border-0 shadow">
                                                    <li> <a href="{{route('user')}}" target="_blank">Dashboard</a></li>
                                                    <li> <a href="{{route('order.track')}}">Track Order</a></li>
                                                </ul>
                                            </li>
                                            @endif
                                            <li> <a href="{{route('user.logout')}}">Logout</a></li>

                                            @else
                                            <li>
                                                <a href="{{route('login.form')}}">Login / Register</a>
                                                {{-- <a href="{{route('register.form')}}">Register</a> --}}
                                            </li>
                                            @endauth
                                            <div class="right-bar">
                                                <!-- Search Form -->
                                                <div class="sinlge-bar shopping">
                                                    @php
                                                    $total_prod=0;
                                                    $total_amount=0;
                                                    @endphp
                                                    @if(session('wishlist'))
                                                    @foreach(session('wishlist') as $wishlist_items)
                                                    @php
                                                    $total_prod+=$wishlist_items['quantity'];
                                                    $total_amount+=$wishlist_items['amount'];
                                                    @endphp
                                                    @endforeach
                                                    @endif
                                                    <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a>
                                                    <!-- Shopping Item -->
                                                    @auth
                                                    <div class="shopping-item">
                                                        <div class="dropdown-cart-header">
                                                            <span>{{count(Helper::getAllProductFromWishlist())}} Items</span>
                                                            <a href="{{route('wishlist')}}">View Wishlist</a>
                                                        </div>
                                                        <ul class="shopping-list">
                                                            {{-- {{Helper::getAllProductFromCart()}} --}}
                                                            @foreach(Helper::getAllProductFromWishlist() as $data)
                                                            @php
                                                            $photo=explode(',',$data->product['photo']);
                                                            @endphp
                                                            <li>
                                                                <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                                <a class="cart-img" href="#"><img src="{{ asset($data->product->firstImage->image_url) }}" alt="{{ asset($data->product->firstImage->image_url) }}"></a>
                                                                <h4 style="max-width: 59%;"><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank" style="color: #17a2b8;">{{$data->product['title']}}</a></h4>
                                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="bottom">
                                                            <div class="total">
                                                                <span>Total</span>
                                                                <span class="total-amount">${{number_format(Helper::totalWishlistPrice(),2)}}</span>
                                                            </div>
                                                            {{-- <a href="{{route('cart')}}" class="btn animate">Cart</a> --}}
                                                        </div>
                                                    </div>
                                                    @endauth
                                                    <!--/ End Shopping Item -->
                                                </div>
                                                {{-- <div class="sinlge-bar">
                                                        <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div> --}}
                                            <div class="sinlge-bar shopping">
                                                <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                                                <!-- Shopping Item -->
                                                @auth
                                                <div class="shopping-item">
                                                    <div class="dropdown-cart-header">
                                                        <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                                                        <a href="{{route('cart')}}">View Cart</a>
                                                    </div>
                                                    <ul class="shopping-list">
                                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                                        @foreach(Helper::getAllProductFromCart() as $data)
                                                        @php
                                                        $photo=explode(',',$data->product['photo']);
                                                        @endphp
                                                        <li>
                                                            <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                            <a class="cart-img" href="#"><img src="{{ asset($data->product->firstImage->image_url) }}" alt="{{ asset($data->product->firstImage->image_url) }}"></a>
                                                            <h4 style="width: 59.5%;"><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank" style="color: #17a2b8;">{{$data->product['title']}}</a></h4>
                                                            <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="bottom">
                                                        <div class="total">
                                                            <span>Total</span>
                                                            <span class="total-amount">${{number_format(Helper::totalCartPrice(),2)}}</span>
                                                        </div>
                                                        {{-- <a href="{{route('checkout')}}" class="btn animate">Checkout</a> --}}
                                                    </div>
                                                </div>
                                                @endauth
                                                <!--/ End Shopping Item -->
                                            </div>
                                    </div>
                                    </ul>
                                </div>
                        </div>
                        </nav>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--/ End Header Inner -->

</header>