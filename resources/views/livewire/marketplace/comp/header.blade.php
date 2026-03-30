<header id="header" class="header-v1">
    <div class="header-top-banner">
        <a href="#"><img src="{{ asset('market/assets/img/banner-top.jpg') }}"
                alt="" class="img-reponsive"></a>
    </div>
    <div class="topbar">
        <div class="container container-240">
            <div class="row flex">
                <div class="col-md-6 col-sm-6 col-xs-4 flex-left">

                </div>
                <div class="col-md-6 col-sm-6 col-xs-8 flex-right">
                    <div class="topbar-right">
                        <div class="element hidden-xs hidden-sm">
                            <a href="#">Buyer Protection </a>
                        </div>
                        <div class="element hidden-xs hidden-sm">
                            <a href="#">Help</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-center">
        <div class="container container-240">
            <div class="row flex">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 v-center header-logo">
                    <a href="#"><img
                            src="{{ asset('assets/images/logo-main.png') }}" alt="" class="img-reponsive"></a>
                </div>
                <div class="col-lg-7 col-md-7 v-center header-search hidden-xs hidden-sm">
                    <form wire:submit='searchProducts()' class="searchform ajax-search"  >
                        <input type="hidden" name="type" value="product">
                        <input type="text" wire:model='search' class="form-control" placeholder="i’m shoping for...">

                        <div class="search-panel">
                            <a class="dropdown-toggle" data-toggle="dropdown" href='#'>All categories <span
                                    class="fa fa-caret-down"></span></a>
                            <ul id="category" class="dropdown-menu dropdown-category">
                                @if (isset($categories))
                                    @foreach ($categories as $cat)
                                        <li><a
                                                href="{{ route('marketplace.user.filterByCat', [$cat->slug]) }}">{{ $cat->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <span class="input-group-btn">
                            <button class="button_search" type="submit"><i class="ion-ios-search-strong"></i></button>
                        </span>
                    </form>

                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6 v-center header-sub">
                    <div class="right-panel">
                        <div class="header-sub-element hidden-xs hidden-sm">

                        </div>
                        <div class="header-sub-element row">
                            <a class="hidden-xs hidden-sm" href="{{ route('profile.index') }}"><img
                                    src="{{ asset('market/assets/img/icon-user.png') }}" alt=""></a>

                            <div class="cart">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false" id="label5">
                                    <img src="{{ asset('market/assets/img/icon-cart.png') }}" alt="">
                                    <span class="count cart-count">{{ $cart?->cartItems?->count() }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-cart">
                                    <ul class="mini-products-list">
                                        @if (isset($cart))


                                            @foreach ($cart?->cartItems as $item)
                                                <li class="item-cart">
                                                    <div class="product-img-wrap">
                                                        <a href="#"><img
                                                                src="{{ asset('market/assets/img/cart1.jpg') }}"
                                                                alt="" class="img-reponsive"></a>
                                                    </div>
                                                    <div class="product-details">
                                                        <div class="inner-left">
                                                            <div class="product-name"><a
                                                                    href="#">{{ $item->name }}
                                                                </a></div>
                                                            <div class="product-price">
                                                                Rs. {{ $item->each }} <span>(
                                                                    x{{ $item->quantity }})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="e-del"><i
                                                            class="ion-ios-close-empty"></i></a>
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                    <div class="bottom-cart">
                                        <div class="cart-price">
                                            <span>Subtotal</span>
                                            <span class="price-total">{{ $cart ? $cart->total_price : 0 }}</span>
                                        </div>
                                        <div class="button-cart">
                                            <a href="{{ route('cart.index') }}"
                                                class="cart-btn e-checkout btn-gradient">View
                                                Cart</a>
                                            {{-- <a href="#" class="cart-btn e-checkout btn-gradient">Checkout</a> --}}
                                            {{-- <a href="#" class="cart-btn e-checkout btn-gradient">Checkout</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="hidden-md hidden-lg icon-pushmenu js-push-menu">
                                <i class="fa fa-bars f-15"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="header-bottom hidden-xs hidden-sm">
        <div class="container container-240">
            <div class="row flex lr2">
                <div class="col-lg-3 widget-verticalmenu">
                    <div class="navbar-vertical">
                        <button class="navbar-toggles"><span>All Departments</span></button>
                    </div>
                    <div class="vertical-wrapper">
                        <ul class="vertical-group">
                            <li class="vertical-item level1 mega-parent"><a href="#">New Arrivals</a></li>
                            <li class="vertical-item level1 mega-parent"><a href="#">Top 100 Best Seller <span class="h-ribbon e-red mg-l10">Hot</span></a></li>
                            <li class="vertical-item level1 vertical-drop"><a href="#">TV & Video</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu v2 tvbg pd2 style1">
                                    <ul class="level1">
                                        <li class="level2 col-md-5">
                                            <a href="#">TVs by Type</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">4K Ultra HD</a></li>
                                                <li class="level3"><a href="#" title="">Smart TVs</a></li>
                                                <li class="level3"><a href="#" title="">LED & LCD TVs & amplifiers</a></li>
                                                <li class="level3"><a href="#" title="">OLED TVs</a></li>
                                                <li class="level3"><a href="#" title="">QLED/Quantum Dot TVs  </a></li>
                                            </ul>
                                            <a href="#">Blu-ray & DVD Players</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">4K Blu-ray Players</a></li>
                                                <li class="level3"><a href="#" title="">Streaming Blu-ray Players</a></li>
                                                <li class="level3"><a href="#" title="">3D Blu-ray Players</a></li>
                                                <li class="level3"><a href="#" title="">Portable Blu-ray Players</a></li>
                                                <li class="level3"><a href="#" title="">DVD Recorders</a></li>
                                            </ul>
                                        </li>
                                        <li class="level2 col-md-7">
                                            <a href="# ">Home Audio</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Home Theater Systems</a></li>
                                                <li class="level3"><a href="#" title="">Soundbars</a></li>
                                                <li class="level3"><a href="#" title="">Speakers</a></li>
                                                <li class="level3"><a href="#" title="">Receivers & Amplifiers</a></li>
                                                <li class="level3"><a href="#" title="">Premium Audio</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="vertical-item level1 vertical-drop"><a href="#">Home Audio & Theater</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu v2 homebg pd2 style1">
                                    <ul class="level1">
                                        <li class="level2 col-md-4">
                                            <a href="#">Home theater</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Sound bars</a></li>
                                                <li class="level3"><a href="#" title="">Speakers</a></li>
                                                <li class="level3"><a href="#" title="">Receivers & amplifiers</a></li>
                                                <li class="level3"><a href="#" title="">Equalizers</a></li>
                                                <li class="level3"><a href="#" title="">Phono preamps  </a></li>
                                            </ul>
                                        </li>
                                        <li class="level2 col-md-4">
                                            <a href="# ">Speakers</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Bluetooth speakers</a></li>
                                                <li class="level3"><a href="#" title="">Ceiling & in-wall speakers</a></li>
                                                <li class="level3"><a href="#" title="">Digital music systems</a></li>
                                                <li class="level3"><a href="#" title="">Outdoor</a></li>
                                                <li class="level3"><a href="#" title="">Satellite speakers</a></li>
                                            </ul>
                                        </li>
                                        <li class="level2 col-md-4">
                                            <a href="#">Accessories</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Receivers & amplifiers</a></li>
                                                <li class="level3"><a href="#" title="">Cd & tape players</a></li>
                                                <li class="level3"><a href="#" title="">Tuners</a></li>
                                                <li class="level3"><a href="#" title="">Curntables</a></li>
                                                <li class="level3"><a href="#" title="">Receivers & adapters</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="vertical-item level1 vertical-drop"><a href="#">Camera, Photo & Video</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu">
                                    <ul class="vertical-menu1">
                                        <li><a href="#">Car Audio</a></li>
                                        <li><a href="#">Radar Detectors</a></li>
                                        <li><a href="#">Car Safety & Security</a></li>
                                        <li><a href="#">Car Video</a></li>
                                        <li><a href="#">Two-Way Radios</a></li>
                                        <li><a href="#">CB Radios & Scanners</a></li>
                                        <li><a href="#">In-Dash Mounting Kits</a></li>
                                        <li><a href="#">Installation Accessories.</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="vertical-item level1 vertical-drop"><a href="#">Cell Phones & Accessories</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu v2 phonebg pd2 style1">
                                    <ul class="level1">
                                        <li class="level2 col-md-4">
                                            <a href="#">Cell Phones</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Samsung Galaxy S8</a></li>
                                                <li class="level3"><a href="#" title="">iPhone 7/7 Plus</a></li>
                                                <li class="level3"><a href="#" title="">iPhone 6</a></li>
                                                <li class="level3"><a href="#" title="">Samsung Galaxy S7</a></li>
                                                <li class="level3"><a href="#" title="">Unlocked Phones</a></li>
                                            </ul>
                                            <a href="#">Cases</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">4Armbands</a></li>
                                                <li class="level3"><a href="#" title="">Armbands</a></li>
                                                <li class="level3"><a href="#" title="">Cases</a></li>
                                                <li class="level3"><a href="#" title="">Flip Cases</a></li>
                                                <li class="level3"><a href="#" title="">Holsters & Clips</a></li>
                                            </ul>
                                        </li>
                                        <li class="level2 col-md-8">
                                            <a href="# ">Accessories</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Batteries</a></li>
                                                <li class="level3"><a href="#" title="">Bluetooth Headsets</a></li>
                                                <li class="level3"><a href="#" title="">Bluetooth Speakers</a></li>
                                                <li class="level3"><a href="#" title="">Car Accessories</a></li>
                                                <li class="level3"><a href="#" title="">Chargers</a></li>
                                            </ul>
                                            <a href="# ">Connected Devices</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Tablets</a></li>
                                                <li class="level3"><a href="#" title="">Mobile Hotspots</a></li>
                                                <li class="level3"><a href="#" title="">Smart Watches</a></li>
                                                <li class="level3"><a href="#" title="">Wearable Technology</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="vertical-item level1 vertical-drop"><a href="#">Headphones</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu v2 headphonebg pd3 style1">
                                    <ul class="level1">
                                        <li class="level2 col-md-6">
                                            <a href="#">Headphones</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">In-Ear & Earbud</a></li>
                                                <li class="level3"><a href="#" title="">On-Ear</a></li>
                                                <li class="level3"><a href="#" title="">Over-Ear</a></li>
                                                <li class="level3"><a href="#" title="">Wireless</a></li>
                                                <li class="level3"><a href="#" title="">Sports & Fitness</a></li>
                                            </ul>
                                        </li>
                                        <li class="level2 col-md-6">
                                            <a href="# ">Speaker System</a>
                                            <ul class="menu-level-2">
                                                <li class="level3"><a href="#" title="">Complete Systems</a></li>
                                                <li class="level3"><a href="#" title="">Sound Bars</a></li>
                                                <li class="level3"><a href="#" title="">Surround Sound</a></li>
                                                <li class="level3"><a href="#" title="">Receivers & Amplifiers</a></li>
                                                <li class="level3"><a href="#" title="">Equalizers</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="vertical-item level1 vertical-drop"><a href="#">Car Electronics</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu">
                                    <ul class="vertical-menu1">
                                        <li><a href="#">Car Audio</a></li>
                                        <li><a href="#">Radar Detectors</a></li>
                                        <li><a href="#">Car Safety & Security</a></li>
                                        <li><a href="#">Car Video</a></li>
                                        <li><a href="#">Two-Way Radios</a></li>
                                        <li><a href="#">CB Radios & Scanners</a></li>
                                        <li><a href="#">In-Dash Mounting Kits</a></li>
                                        <li><a href="#">Installation Accessories.</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="vertical-item level1 vertical-drop"><a href="#">Electronics Showcase</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu">
                                    <ul class="vertical-menu1">
                                        <li><a href="#">Car Audio</a></li>
                                        <li><a href="#">Radar Detectors</a></li>
                                        <li><a href="#">Car Safety & Security</a></li>
                                        <li><a href="#">Car Video</a></li>
                                        <li><a href="#">Two-Way Radios</a></li>
                                        <li><a href="#">CB Radios & Scanners</a></li>
                                        <li><a href="#">In-Dash Mounting Kits</a></li>
                                        <li><a href="#">Installation Accessories.</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="vertical-item level1 vertical-drop mega-parent"><a href="#">All categlories</a>
                                <div class="menu-level-1 dropdown-menu vertical-menu v2 pd">
                                    <div class="row">
                                        <div class="col-md-4 text-center cate-item">
                                            <a href="#"><img src="{{ asset('market/assets/img/megamenu/cate1.jpg') }}" alt="" class="img-reponsive"></a>
                                            <h3><a href="#">Mirrorless Cameras</a></h3>
                                        </div>
                                        <div class="col-md-4 text-center cate-item">
                                            <a href="#"><img src="{{ asset('market/assets/img/megamenu/cate2.jpg') }}" alt="" class="img-reponsive"></a>
                                            <h3><a href="#">Lenses</a></h3>
                                        </div>
                                        <div class="col-md-4 text-center cate-item">
                                            <a href="#"><img src="{{ asset('market/assets/img/megamenu/cate3.jpg') }}" alt="" class="img-reponsive"></a>
                                            <h3><a href="#">Photography Drones</a></h3>
                                        </div>
                                        <div class="col-md-4 text-center cate-item">
                                            <a href="#"><img src="{{ asset('market/assets/img/megamenu/cate4.jpg') }}" alt="" class="img-reponsive"></a>
                                            <h3><a href="#">Sports & Action Cameras</a></h3>
                                        </div>
                                        <div class="col-md-4 text-center cate-item">
                                            <a href="#"><img src="{{ asset('market/assets/img/megamenu/cate5.jpg') }}" alt="" class="img-reponsive"></a>
                                            <h3><a href="#">Optics</a></h3>
                                        </div>
                                        <div class="col-md-4 text-center cate-item">
                                            <a href="#"><img src="{{ asset('market/assets/img/megamenu/cate6.jpg') }}" alt="" class="img-reponsive"></a>
                                            <h3><a href="#">Accessories</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 widget-left">
                    <div class="flex lr">
                        <nav class="main-menu">
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav">
                                    <li class="level1"><a href="#"><img src="{{ asset('market/assets/img/icon-diamond.png') }}" alt="">Flash Deals</a></li>
                                    <li class="level1"><a href="#">Tech Discovery<span class="h-ribbon h-pos e-skyblue">New</span></a></li>
                                    <li class="level1"><a href="#">Trending Styles</a></li>
                                    <li class="level1"><a href="#">Gift Cards <span class="h-ribbon h-pos e-green">sale</span></a></li>
                                </ul>
                            </div>
                        </nav>
                        <div class="header-bottom-right hidden-xs hidden-sm">
                            <img src="{{ asset('market/assets/img/icon-ship.png') }}" alt="" class="img-reponsive">
                            <span>Free Shipping on Orders $100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</header>
