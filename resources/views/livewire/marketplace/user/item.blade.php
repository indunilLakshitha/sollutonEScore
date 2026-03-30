<div>
    <div class="container container-240">
        <div class="single-product-detail product-bundle product-aff">
            <ul class="breadcrumb">
                {{-- <li><a href="#">Home</a></li>
                <li class="active">Accessories</li>
                <li class="active">Ultra Wireless S50 Headphones </li> --}}
            </ul>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="flex product-img-slide" wire:ignore>
                        <div class="product-images">
                            <div class="main-img js-product-slider">
                                <a href="#" class="hover-images effect"><img
                                        src="{{ asset('storage/' . $item?->images[0]->image_name) }}" alt="photo"
                                        class="img-reponsive"></a>
                                @foreach ($item?->images as $image)
                                    <a href="#" class="hover-images effect"><img
                                            src="{{ asset('storage/' . $image?->image_name) }}" alt="photo"
                                            class="img-reponsive"></a>
                                @endforeach


                                {{-- <a href="#" class="hover-images effect"><img src="img/single/sony4.jpg"
                                        alt="photo" class="img-reponsive"></a>
                                <a href="#" class="hover-images effect"><img src="img/single/sony4.jpg"
                                        alt="photo" class="img-reponsive"></a> --}}
                            </div>
                        </div>
                        <div class="multiple-img-list-ver2 js-click-product">
                            <div class="product-col">
                                <div class="img active">
                                    <img src="{{ asset('storage/' . $item?->images[0]->image_name) }}" alt="photo"
                                        class="img-reponsive">
                                </div>
                            </div>
                            @foreach ($item?->images as $image)
                                <div class="product-col">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $image?->image_name) }}" alt="images"
                                            class="img-responsive">
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="product-col">
                                <div class="img">
                                    <img src="img/single/sony4.jpg" alt="images" class="img-responsive">
                                </div>
                            </div>
                            <div class="product-col">
                                <div class="img">
                                    <img src="img/single/sony4.jpg" alt="images" class="img-responsive">
                                </div>
                            </div> --}}
                        </div>
                    </div>


                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="single-flex">
                        <div class="single-product-info product-info product-grid-v2 s-50">
                            {{-- <p class="product-cate">Audio Speakers</p> --}}
                            {{-- <div class="product-rating">
                                <span class="star star-5"></span>
                                <span class="star star-4"></span>
                                <span class="star star-3"></span>
                                <span class="star star-2"></span>
                                <span class="star star-1"></span>
                                <div class="number-rating">( 896 reviews )</div>
                            </div> --}}
                            <h3 class="product-title"><a href="#">{{ $item->title }} </a></h3>
                            <div class="product-price">
                                <span>{{ env('CURRENCY') }}{{ $total_price }}</span>
                            </div>
                            <div class="availability">
                                <p class="product-inventory"> <label>Availability : </label><span> In stock</span></p>
                            </div>
                            {{-- <div class="product-brand">
                                <p>Brand :</p>
                                <img src="img/single/sony_brand.png" alt="">
                            </div> --}}
                            <div class="product-sku">
                                <label>SKU :</label><span> {{ $item->sku }}</span>
                            </div>
                            <div class="short-desc">
                                <p class="product-desc">{!! $item->description !!}</p>
                                {{-- <ul class="desc-list">
                                    <li>Connects directly to Bluetooth</li>
                                    <li>Battery Indicator light</li>
                                    <li>DPI Selection:2600/2000/1600/1200/800</li>
                                    <li>Computers running Windows</li>
                                </ul> --}}
                            </div>
                            @if (isset($item->colors) && count($item->colors) > 0)
                                <div class="color-group">
                                    <label>Availble Colors :</label>
                                    @foreach ($item->colors as $color)
                                        <a class="circle " wire:click='setColor({{ $color->color->id }})'
                                            style="background-color: {{ $color->color->code }};"></a>
                                    @endforeach

                                </div>
                                <div class="single-product-button-group ml-5">
                                    <label for="size">Color : </label>
                                    <div class="select-custom set-left-margin">
                                        <select name="color_id" wire:model='color_id' required
                                            class="form-control ml-5">
                                            <option value="">Select a color</option>
                                            @foreach ($item->colors as $color)
                                                <option value="{{ $color->color->id }}">{{ $color->color->name }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if (isset($item->sizes) && count($item->sizes) > 0)
                                <div class="single-product-button-group ml-5">
                                    <label for="size">Available Sizes : </label>
                                    <div class="select-custom set-left-margin">
                                        <select name="size_id" wire:model='size_id' required wire:change='selectSize()'
                                            class="form-control getSizePrice">
                                            <option data-price="0" value="">Select a size</option>
                                            @foreach ($item->sizes as $size)
                                                <option data-price="{{ !empty($size->price) ? $size->price : 0 }}"
                                                    value="{{ $size->id }}">{{ $size->name }}
                                                    @if (!empty($size->price))
                                                        (Rs. {{ number_format($size->price, 2) }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="single-product-button-group">
                                <div class="e-btn cart-qtt btn-gradient">
                                    <div class="e-quantity">
                                        <input type="number" step="1" min="1" max="999"
                                            name="quantity" value="1" title="Qty"
                                            class="qty input-text js-number" size="4" wire:model='quantity'
                                            wire:change='setQty()'>
                                        <div class="tc pa">
                                            {{-- <a class="js-plus quantity-right-plus"><i class="fa fa-caret-up"></i></a>
                                            <a class="js-minus quantity-left-minus"><i class="fa fa-caret-down"></i></a> --}}
                                        </div>
                                    </div>
                                    <a class="btn-add-cart add-padding"
                                        wire:click='processAddToCart({{ $item->id }})'> <span
                                            class="icon-bg icon-cart v2"></span></a>
                                </div>
                                <div class="e-btn cart-qtt btn-gradient">

                                    <input type="hidden" step="1" min="1" max="999" name="quantity"
                                        value="1" title="Qty" class="qty input-text js-number" size="4"
                                        wire:model='quantity' wire:change='setQty()'>


                                    <a wire:click='buyNow({{ $item->id }})'class="btn-add-cart"> <span
                                            class="icon-bg icon-cart v2"></span>
                                        <p style="margin-left: 15px">Buy Now</p>
                                    </a>
                                </div>
                                {{-- <a href="#" class="e-btn btn-icon">
                                    <span class="icon-bg icon-wishlist"></span>
                                </a>
                                <a href="#" class="e-btn btn-icon">
                                    <span class="icon-bg icon-compare"></span>
                                </a> --}}
                            </div>

                            {{-- <div class="product-tags">
                                <label>Tags :</label>
                                <a href="#">Fast,</a>
                                <a href="#">Gaming,</a>
                                <a href="#">Strong</a>
                            </div> --}}
                        </div>


                    </div>
                </div>
            </div>
            <div class="single-product-tab bd-7">
                <div class="cmt-title text-center abs">
                    <ul class="nav nav-tabs text-center">

                        <li><a data-toggle="pill" href="#review">Reviews</a></li>
                    </ul>
                </div>



                <div class="tab-content">
                    <div id="review" class="tab-pane fade in active">
                        <div class="entry-content">
                            <div class="entry-img-first text-center image-bd">
                                <img src="img/single/des_3.jpg" alt="">
                            </div>
                            <div class="entry-inside">
                                @if (Auth::check())
                                    <div class="entry-element flex align-center">
                                        <div class="entry-img text-center">
                                            <img src="img/single/bass2.png" alt="">
                                        </div>
                                        <div class="entry-info">
                                            <h3>Write Your Review</h3>
                                            <div>
                                                <form class="rating">
                                                    <label>
                                                        <input type="radio" wire:model='star_value' name="stars"
                                                            value="1" />
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" wire:model='star_value' name="stars"
                                                            value="2" />
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" wire:model='star_value' name="stars"
                                                            value="3" />
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" wire:model='star_value' name="stars"
                                                            value="4" />
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" wire:model='star_value' name="stars"
                                                            value="5" />
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                </form>
                                            </div>
                                            <textarea name="" id="" cols="30" rows="5" class="form-control" wire:model='review_msg'
                                                placeholder="Write your Review Here"></textarea>
                                            <button id="subscribe" class="button_mini btn btn-gradient"
                                                wire:click='submitReview()' style="margin-top: 5px" type="button">
                                                SUBMIT
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                @foreach ($reviews as $review)
                                    <div class=" flex align-center" style="margin-top: 15px;margin-bottom: 15px">

                                        <div class="entry-info">
                                            <h3>
                                                @for ($x = 1; $x <= $review->rating; $x++)
                                                    <span class="icon">★</span>
                                                @endfor
                                            </h3>
                                            <h1 style="margin-bottom: 10px;font-size: 20px">
                                                {{ $review->user->first_name . ' ' . $review->user->last_name }}</h1>
                                            <h1 style="margin-bottom: 10px;font-size: 15px">
                                                {{ $review->created_at }}</h1>
                                            <p>{{ $review->review }}</p>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <style>
            .set-left-margin {
                margin-left: 5px;
            }

            .rating {
                display: inline-block;
                position: relative;
                height: 50px;
                line-height: 50px;
                font-size: 50px;
            }

            .rating label {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                cursor: pointer;
            }

            .rating label:last-child {
                position: static;
            }

            .rating label:nth-child(1) {
                z-index: 5;
            }

            .rating label:nth-child(2) {
                z-index: 4;
            }

            .rating label:nth-child(3) {
                z-index: 3;
            }

            .rating label:nth-child(4) {
                z-index: 2;
            }

            .rating label:nth-child(5) {
                z-index: 1;
            }

            .rating label input {
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0;
            }

            .rating label .icon {
                float: left;
                color: transparent;
            }

            .rating label:last-child .icon {
                color: #000;
            }

            .rating:not(:hover) label input:checked~.icon,
            .rating:hover label:hover input~.icon {
                color: #09f;
            }

            .rating label input:focus:not(:checked)~.icon:last-child {
                color: #000;
                text-shadow: 0 0 5px #09f;
            }

            .add-padding {
                padding-left: 18px;
                padding-right: 28px;
                padding-top: 15px;
                padding-bottom: 15px;
            }

        </style>
    </div>
