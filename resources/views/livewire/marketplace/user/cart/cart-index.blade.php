<div>
    <div class="container container-240">
        @if (!$is_checkout)
            <div class="checkout">
                <ul class="breadcrumb v3">
                    <li><a href="#">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="shopping-cart bd-7">
                            <div class="cmt-title text-center abs">
                                <h1 class="page-title v2">Cart</h1>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <tbody>
                                        @if (isset($cart))


                                            @foreach ($cart?->cartItems as $item)
                                                <tr class="item_cart">
                                                    <td class="product-name flex align-center">
                                                        <a wire:click='removeItemFromCart({{ $item->id }})'
                                                            class="btn-del"><i class="ion-ios-close-empty"></i></a>
                                                        <div class="product-img">
                                                            <img src="{{ asset('storage/' . $item?->image?->image_name) }}"
                                                                alt="Futurelife">
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="#" title="">{{ $item->name }} </a>
                                                            <div class="co-name">
                                                                @if (isset($item->size_detail))
                                                                    SIZE : {{ $item->size_detail }}
                                                                @endif
                                                                <br>
                                                                @if (isset($item->color_detail))
                                                                    SIZE : {{ $item->color_detail }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="bcart-quantity single-product-detail">
                                                        <div class="single-product-info">
                                                            <div class="e-quantity">
                                                                <input type="number" step="1" min="1"
                                                                    max="999" name="quantity"
                                                                    wire:input='changeQty({{ $item->quantity }},{{ $item->id }})'
                                                                    value="{{ $item->quantity }}" title="Qty"
                                                                    class="qty input-text js-number" size="4"
                                                                    disabled>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="total-price">
                                                        <p class="price">
                                                            {{ env('CURRENCY') }}{{ $item->quantity * $item->each }}</p>
                                                    </td>
                                                    {{-- @php

                                                    $total += $item->quantity * $item->each;
                                                @endphp --}}
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-cart-bottom">

                                <form class="form_coupon" action="#" method="post">
                                    <input type="text" value="" placeholder="Coupon code" name="EMAIL"
                                        wire:model='coupen_code' id="mail" class="newsletter-input form-control">
                                    <div class="input-icon">
                                        <img src="{{ asset('/market/assets/img/coupon-icon.png') }}" alt="">
                                    </div>
                                    <button id="subscribe2" class="button_mini btn" type="button"
                                        wire:click='applyCoupen()'>
                                        Apply coupon
                                    </button>
                                </form>

                                {{-- <a href="#" class="btn btn-update">Update cart</a> --}}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="cart-total bd-7">
                            <div class="cmt-title text-center abs">
                                <h1 class="page-title v3">Cart totals</h1>
                            </div>

                            <div class="table-responsive">
                                <table class="shop_table">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td>{{ env('CURRENCY') }}{{ $total }}</td>
                                        </tr>
                                        @if ($coupen_applied)
                                            <tr class="cart-shipping">
                                                <th>Coupen Applied</th>
                                                <td class="td">

                                                    {{ $coupen_code }}
                                                </td>
                                            </tr>
                                            <tr class="cart-shipping">
                                                <th>Discount</th>
                                                <td class="td">

                                                    Rs. {{ $discount }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr class="cart-subtotal">
                                            <th>Total</th>
                                            <td>{{ env('CURRENCY') }}{{ $final_total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="cart-total-bottom">
                                <button type="button" wire:click='checkout()'
                                    class="btn-gradient btn-checkout checkout-btn">Proceed
                                    to
                                    checkout</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($is_checkout)
            <div class="container container-240">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
                <div class="co-coupon">

                </div>
                <form name="checkout" method="post" class="co">
                    <div class="cart-box-container-ver2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="co-left bd-7">
                                    <div class="cmt-title text-center abs">
                                        <h1 class="page-title v1">Billing details</h1>
                                    </div>
                                    <div class="row form-customer">
                                        <div class="form-group col-md-6">
                                            <label for="inputfname_2" class=" control-label">First Name <span
                                                    class="f-red">*</span></label>
                                            <input type="text" id="inputfname_2" wire:model='first_name' required
                                                class="form-control form-account">

                                            @error('first_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputlname" class=" control-label">Last Name <span
                                                    class="f-red">*</span></label>
                                            <input type="text" wire:model='last_name' id="inputlname"required
                                                class="form-control form-account">
                                            @error('last_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputstreet" class=" control-label">Street address <span
                                                    class="f-red">*</span></label>
                                            <input type="text" wire:model='address_line_one' id="inputstreet"
                                                class="form-control form-account">
                                            @error('address_line_one')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputpostcode" class=" control-label">Postcode / ZIP</label>
                                            <input type="text" wire:model='postal_code' id="inputpostcode"required
                                                class="form-control form-account">
                                            @error('postal_code')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputfState" class=" control-label">Town / City <span
                                                    class="f-red">*</span></label>
                                            {{-- <input type="text" id="inputfState" class="form-control form-account"> --}}
                                            <select name="form-select select-box form-account" id=""required
                                                wire:model='city'>
                                                <option value="0">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('city')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputphone" class=" control-label">Phone <span
                                                    class="f-red">*</span></label>
                                            <input type="text" id="inputphone" wire:model='phone_number'required
                                                class="form-control form-account">
                                            @error('phone_number')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputemail" class=" control-label">Email Address <span
                                                    class="f-red">*</span></label>
                                            <input type="text" id="inputemail" wire:model='email'required
                                                class="form-control form-account">
                                            @error('email')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-check col-md-12">
                                            <label class="form-check-label ver2">
                                                <input type="checkbox" class="form-check-input">
                                                <span>Create an account?</span>
                                            </label>
                                        </div> --}}
                                    </div>
                                </div>

                            </div>
                            <!-- End contact-form -->
                            <div class="col-md-4">
                                <div class="cart-total bd-7  checkout-btn">
                                    <div class="cmt-title text-center abs">
                                        <h1 class="page-title v3">Your order</h1>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="co-pd">
                                            <p class="co-title">
                                                Product<span>Total</span>
                                            </p>
                                            @if (isset($cart))
                                                @foreach ($cart?->cartItems as $item)
                                                    <ul class="co-pd-list">
                                                        <li class="clearfix">
                                                            <div class="co-name">
                                                                {{ $item->name }} x {{ $item->quantity }}
                                                            </div>
                                                            <div class="co-price">
                                                                Rs. {{ $item->quantity * $item->each }}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        </div>
                                        <table class="shop_table">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td>{{ env('CURRENCY') }}{{ $total }}</td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>Discount</th>
                                                    <td>{{ env('CURRENCY') }}{{ $discount }}</td>
                                                </tr>
                                                @if (isset($delivery_data))
                                                    <tr class="cart-shipping v2">
                                                        <th>Delivery (Rs)</th>
                                                        <td class="td">
                                                            <ul class="shipping">
                                                                @foreach ($delivery_data as $delivery)
                                                                    <li>
                                                                        <input type="radio"
                                                                            name="delivery{{ $delivery->id }}"
                                                                            required value="{{ $delivery->id }}"
                                                                            wire:model='selected_delivery'
                                                                            id="delivery{{ $delivery->id }}"
                                                                            wire:change='setDeliveryMethod()'>
                                                                        <label
                                                                            for="delivery{{ $delivery->id }}">{{ $delivery->name }}
                                                                            :
                                                                            {{ $delivery->price }}</label>
                                                                    </li>
                                                                @endforeach
                                                                {{-- <li>
                                                                    <input type="radio" name="gender"
                                                                        value="Free" id="radio2">
                                                                    <label for="radio2">Free Shipping</label>
                                                                </li> --}}
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if (isset($paymentModes))
                                                    <tr class="cart-shipping v2">
                                                        <th>Pay By (Rs)</th>
                                                        <td class="td">
                                                            <ul class="shipping">
                                                                @foreach ($paymentModes as $mode)
                                                                    @if ($mode->lable != 'WALLET')
                                                                        <li>
                                                                            <input type="radio"
                                                                                name="payment{{ $mode->id }}"
                                                                                required
                                                                                wire:model='selected_payment_mode'
                                                                                value="{{ $mode->id }}"
                                                                                id="payment{{ $mode->id }}">
                                                                            <label for="payment{{ $mode->id }}">
                                                                                {{ $mode->lable }}
                                                                            </label>
                                                                        </li>
                                                                    @endif
                                                                    @if ($mode->lable == 'WALLET')
                                                                        @if ($wallet_points > 0)
                                                                            <li>
                                                                                <input type="radio"
                                                                                    name="payment{{ $mode->id }}"
                                                                                    required
                                                                                    wire:model='selected_payment_mode'
                                                                                    value="{{ $mode->id }}"
                                                                                    id="payment{{ $mode->id }}">
                                                                                <label
                                                                                    for="payment{{ $mode->id }}">
                                                                                    {{ $mode->lable }} @if ($mode->lable == 'WALLET')
                                                                                        ({{ $wallet_points }})
                                                                                    @endif
                                                                                </label>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                {{-- <li>
                                                                    <input type="radio" name="gender"
                                                                        value="Free" id="radio2">
                                                                    <label for="radio2">Free Shipping</label>
                                                                </li> --}}
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr class="order-total v2">
                                                    <th>Total</th>
                                                    <td>{{ env('CURRENCY') }}{{ $final_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <ul class="payment">


                                    </ul>


                                    <div class="cart-total-bottom v2">
                                        <button type="button" wire:click='checkPaymentMode()'
                                            class="btn-gradient btn-checkout btn-co-order">Place
                                            order</button>
                                        <button type="button" wire:click='viewCart()'
                                            class="btn-gradient btn-checkout btn-co-order cart-btn">View Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
    <style>
        select {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857;
            color: #555555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-appearance: none;

            height: 54px;
            border-radius: 999px;
            border: 1px solid #e1e1e1;
            padding-left: 33px;
            margin-bottom: 15px;
            position: relative;

        }

        select::after {
            content: '';
            background-image: url('http://127.0.0.1:8000/market/assets/img/img_arrow_down.png');
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
        }

        .checkout-btn {
            margin-bottom: 10px;
        }

        .cart-btn {
            margin-left: 10px;
        }

        .cart-total th {
            padding: 30px 20px !important;
        }

        @media only screen and (max-width: 1024px) {
            .shop_table tbody tr {
                display: flex;
                flex-direction: column;
            }

            .cart-total th {
                padding: 15px 20px 0px 20px !important;
            }

            .cart-total .cart-subtotal td {
                padding: 0px 20px 15px 20px;

            }
        }
    </style>
</div>
