<div>
    <!--content-->
    <div class="container container-240 shop-collection">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Shop</li>
        </ul>
        <div class="filter-collection-left hidden-lg hidden-md">
            <a class="btn">Filter</a>
        </div>
        <div class="row shop-colect">
            <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar" id="filter-sidebar">
                <div class="close-sidebar-collection hidden-lg hidden-md">
                    <span>filter</span><i class="icon_close ion-close"></i>
                </div>
                <div class="filter filter-cate">
                    <ul class="wiget-content v2">
                        @foreach ($categories as $cat)
                            <li class="active"><a
                                    href="{{ route('marketplace.user.filterByCat', [$cat->slug]) }}">{{ $cat->name }}
                                    <span class="number">({{ $cat->products_count }})</span></a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="filter filter-group">
                    <h1 class="widget-blog-title">Product filter</h1>
                    <div class="filter-price filter-inside">
                        <h3>Price</h3>
                        <div class="filter-content">
                            <div class="price-range-holder">

                                <input type="number" min="0" class="form-control" placeholder="Min"
                                    wire:model="minPrice">
                                <input type="number" min="0" class="form-control "
                                    style="margin-top: 3px;margin-bottom: 5px" placeholder="Max" wire:model="maxPrice">
                            </div>
                            {{-- <span class="min-max">
                                Price: {{ $minPrice }}
                                Price: {{ $maxPrice }}
                            </span> --}}
                            <button type="button" wire:click='filter' class="btn-filter e-gradient">Filter</button>
                        </div>
                    </div>
                    <div class="filter-brand filter-inside">
                        @if (sizeof($brands) > 0)
                            <h3>Brands</h3>
                            <ul class="e-filter brand-filter">
                                @foreach ($brands as $brand)
                                    <input type="checkbox" style="margin-right: 2px" name="brand{{ $brand->id }}"
                                        required value="{{ $brand->id }}" wire:model='selected_brands'
                                        id="brand{{ $brand->id }}">
                                    <label for="brand{{ $brand->id }}" class="remove-bold">{{ $brand->name }}
                                    </label>
                                    <br>
                                @endforeach

                            </ul>
                        @endif
                    </div>
                    <div class="filter-brand filter-inside">
                        @if (sizeof($colors) > 0)
                            <h3>Colors</h3>
                            <ul class="e-filter brand-filter">
                                @foreach ($colors as $color)
                                    <input type="checkbox" style="margin-right: 2px" name="color{{ $color->id }}"
                                        required value="{{ $color->id }}" wire:model='selected_colors'
                                        id="color{{ $color->id }}">
                                    <label for="color{{ $color->id }}" class="color-group remove-bold">{{ $color->name }}
                                        {{-- <a class="circle " style="background-color: {{ $color->code }};"></a> --}}
                                    </label>

                                    <br>
                                @endforeach

                            </ul>
                        @endif
                    </div>
                </div>

                <div class="banner">
                    <a class="image-bd hover-images" href=""><img
                            src="{{ asset('market/assets/img/o-banner3.jpg') }}" alt=""
                            class="img-reponsive"></a>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12 collection-list">
                <div class="e-product">
                    <div class="pd-banner">
                        <a href="" class="image-bd effect_img2"><img
                                src="{{ asset('market/assets/img/shop-banner_3.jpg') }}" alt=""
                                class="img-reponsive"></a>
                    </div>
                    <div class="pd-top">
                        <h1 class="title">Shop</h1>
                    </div>
                    <div class="pd-middle">
                        <div class="view-mode view-group">
                            <a class="grid-icon col active"><img src="{{ asset('market/assets/img/grid.png') }}"
                                    alt=""></a>
                            <a class="grid-icon col2"><img src="{{ asset('market/assets/img/grid2.png') }}"
                                    alt=""></a>
                            <a class="list-icon list"><img src="{{ asset('market/assets/img/list.png') }}"
                                    alt=""></a>
                        </div>
                        <div class="pd-sort">

                        </div>
                    </div>
                    <div class="product-collection-grid product-grid">
                        <div class="row">

                            @foreach ($products as $product)
                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 product-item">
                                    <div class="pd-bd product-inner">
                                        <div class="product-img">
                                            <a href="{{ route('marketplace.item.view', ['slug' => $product->slug]) }}"><img
                                                    src=" {{ asset('storage/' . $product?->image?->image_name) }}"
                                                    alt="" class="img-reponsive"></a>

                                        </div>
                                        <div class="product-info">
                                            <div class="color-group"></div>
                                            <div class="element-list element-list-left">
                                                {{-- <ul class="desc-list">
                                                    <li>Connects directly to Bluetooth</li>
                                                    <li>Battery Indicator light</li>
                                                    <li>DPI Selection:2600/2000/1600/1200/800</li>
                                                    <li>Computers running Windows</li>
                                                </ul> --}}
                                            </div>
                                            <div class="element-list element-list-middle">
                                                <div class="product-rating bd-rating">
                                                    @for ($x = 1; $x <= $product['rating_value']; $x++)
                                                        <span class="star star-5"></span>
                                                    @endfor
                                                    {{-- <span class="star star-4"></span>
                                                    <span class="star star-3"></span>
                                                    <span class="star star-2"></span>
                                                    <span class="star star-1"></span> --}}
                                                    <div class="number-rating">( {{ $product->reviews->count() }}
                                                        reviews )</div>
                                                </div>
                                                <p class="product-cate">{{ $product->category?->name }}</p>
                                                <h3 class="product-title"><a
                                                        href="{{ route('marketplace.item.view', ['slug' => $product->slug]) }}">{{ $product->title }}</a>
                                                </h3>
                                                <div class="product-bottom">
                                                    <div class="product-price">
                                                        <span
                                                            class="red">{{ env('CURRENCY') }}{{ $product->price }}</span>
                                                        <span
                                                            class="old">{{ env('CURRENCY') }}{{ $product->old_price }}</span>
                                                    </div>
                                                    <a href="{{ route('marketplace.item.view', ['slug' => $product->slug]) }}"
                                                        class="btn-icon btn-view">
                                                        <span class="icon-bg icon-view"></span>
                                                    </a>
                                                </div>
                                                <div class="product-bottom-group">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pd-middle space-v1">

                        <div class="pd-sort">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="e-category">

    </div>
    <div class="feature">
        <div class="container container-240">
            <div class="feature-inside">
                <div class="feature-block text-center">
                    <div class="feature-block-img"><img src="{{ asset('market/assets/img/feature/truck.png') }}"
                            alt="" class="img-reponsive"></div>
                    <div class="feature-info">
                        <h3>Worldwide Delivery</h3>
                        <p>With sites in 5 languages, we ship to over 200 countries & regions.</p>
                    </div>
                </div>

                <div class="feature-block text-center">
                    <div class="feature-block-img"><img
                            src="{{ asset('market/assets/img/feature/credit-card.png') }}" alt=""
                            class="img-reponsive"></div>
                    <div class="feature-info">
                        <h3>Safe Payment</h3>
                        <p>Pay with the world’s most popular and secure payment methods.</p>
                    </div>
                </div>

                <div class="feature-block text-center">
                    <div class="feature-block-img"><img src="{{ asset('market/assets/img/feature/safety.png') }}"
                            alt="" class="img-reponsive"></div>
                    <div class="feature-info">
                        <h3>Shop with Confidence</h3>
                        <p>Our Buyer Protection covers your purchase from click to delivery.</p>
                    </div>
                </div>

                <div class="feature-block text-center">
                    <div class="feature-block-img"><img src="{{ asset('market/assets/img/feature/telephone.png') }}"
                            alt="" class="img-reponsive"></div>
                    <div class="feature-info">
                        <h3>24/7 Help Center</h3>
                        <p>Round-the-clock assistance for a smooth shopping experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / end content -->
    <style>
        .remove-bold {
            font-weight: normal !important;
        }
    </style>
</div>

<script>
    let minInput = document.getElementById('minPrice');
    let maxInput = document.getElementById('maxPrice');

    minInput.addEventListener('input', function() {
        if (parseInt(minInput.value) > parseInt(maxInput.value)) {
            minInput.value = maxInput.value;
        }
    });

    maxInput.addEventListener('input', function() {
        if (parseInt(maxInput.value) < parseInt(minInput.value)) {
            maxInput.value = minInput.value;
        }
    });
</script>
