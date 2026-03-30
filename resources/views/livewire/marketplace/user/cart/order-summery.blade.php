<div>
    <div class="container container-240">

        <div class="checkout">
            <ul class="breadcrumb v3">
                <li><a href="#">Home</a></li>
                <li class="active">Order Summery</li>
            </ul>
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="shopping-cart bd-7">
                        <div class="cmt-title text-center abs">
                            <h1 class="page-title v2">Items</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <tbody>



                                    @foreach ($order?->items as $item)
                                        <tr class="item_cart">
                                            <td class="product-name flex align-center">

                                                <div class="product-img">
                                                    <img src="{{ asset('storage/' . $item?->product?->image?->image_name) }}"
                                                        alt="Futurelife">
                                                </div>
                                                <div class="product-info">
                                                    <a href="#" title="">{{ $item->product?->title }} </a>
                                                    <div class="co-name">
                                                        @if (isset($item->size_name))
                                                            SIZE : {{ $item->size_name }}
                                                        @endif
                                                        <br>
                                                        @if (isset($item->color_name))
                                                            SIZE : {{ $item->color_name }}
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
                                                            class="qty input-text js-number" size="4" disabled>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="total-price">
                                                <p class="price">
                                                    {{ env('CURRENCY') }}{{ $item->quantity * $item->price }}</p>
                                            </td>
                                            {{-- @php

                                                    $total += $item->quantity * $item->each;
                                                @endphp --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="cart-total bd-7">
                        <div class="cmt-title text-center abs">
                            <h1 class="page-title v3">Order Totals</h1>
                        </div>

                        <div class="table-responsive">
                            <table class="shop_table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal ({{ env('CURRENCY_MARKET')}})</th>
                                        <td>{{ number_format($total, 2) }}</td>
                                    </tr>
                                    @if ($coupen_applied)
                                        <tr class="cart-shipping">
                                            <th>Coupen Applied</th>
                                            <td class="td">

                                                {{ $order->coupen->code }}
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
                                        <th>Total ({{ env('CURRENCY_MARKET')}})</th>
                                        <td>{{ number_format($final_total,2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-total-bottom">
                            <a type="button" href="#"
                                class="btn-gradient btn-checkout checkout-btn">HOME</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
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
    </style>
</div>
