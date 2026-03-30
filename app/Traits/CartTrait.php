<?php

namespace App\Traits;

use App\Models\Marketplace\Cart;
use App\Models\Marketplace\CartItem;
use App\Models\Marketplace\Product;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait CartTrait
{
    public function addToCart(string $userId = null): Cart
    {
        if (!isset($userId))
            $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!isset($cart)) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }

        return $cart;
    }

    public function addToCartItems(
        Cart $cart,
        string $productId,
        string $price,
        string $color = null,
        string $size = null
    ) {
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();
        $product = Product::where('id', $productId)->first();
        $total = $cart->total_price;
        if (!isset($cartItem)) {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $productId;


            $cartItem->name = $product->title;
            $cartItem->quantity = 1;
            $cartItem->each =  $price;
            $total +=  $cartItem->quantity * $price;
        } else {
            $cartItem->quantity += 1;
            $cartItem->each =  $price;
            $total +=  $cartItem->quantity * $price;
        }

        $cart->total_price =  $total;
        $cart->save();
        $cartItem->save();

        return;
    }

    public function addToCartItemsWithQty(
        Cart $cart,
        string $productId,
        string $qty,
        string $price,
        string $color = null,
        string $size = null
    ) {

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->where('attributes', json_encode(['size_id' => $size, 'color_id' => $color]))
            ->first();

        $product = Product::where('id', $productId)->first();

        if (!isset($cartItem)) {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $productId;

            $cartItem->name = $product->title;
            $cartItem->quantity = $qty;
            $cartItem->each =  $price;
            $cartItem->attributes  =  json_encode(['size_id' => $size, 'color_id' => $color]);
            $total =  $cartItem->quantity * $price;
            $cart->total_price +=  $total;
        } else {

            $cartItem->quantity += $qty;
            $cartItem->each =  $price;
            $cartItem->attributes  =  ['size_id' => $size, 'color_id' => $color];
            $total =  $cartItem->quantity * $price;
            $cart->total_price +=  $total;
        }


        $cart->save();
        $cartItem->save();

        return;
    }

    public function getCart(string $userId)
    {
        return Cart::with('cartItems.image')->where('user_id', $userId)->first();
    }
}
