<div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner" style="width: -webkit-fill-available; display: flex; justify-content: center;">
                                        <ul class="nav main-menu menu navbar-nav nav-side-menu" style="justify-content: center; padding-bottom: 25px; width: 78%;">
                                            <center>
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
                                            <div class="right-bar" style="float: none;">
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
                                                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
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
                                                            <a href="{{route('cart')}}" class="btn animate">Cart</a>
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
                                                            <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
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
                                                        <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                                                    </div>
                                                </div>
                                                @endauth
                                                <!--/ End Shopping Item -->
                                            </div>
                                    </div>
                                    </center>
                                    </ul>
                                </div>
                        </div>
                        </nav>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>