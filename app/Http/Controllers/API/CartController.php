<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function item()
    {
        $cartItems = Cart::content();
        return response()->json($cartItems);
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = Cart::add([
            'id'     => $product->id,
            'name'   => $product->product_name,
            'qty'    => 1,
            'price'  => ceil($product->discount_price ? $product->discount_price : $product->price),
            'weight' => 0,
            'options' => [
                'image'  => $product->thumbnail,
                'url'    => $product->slug,
            ],
        ]);
        return response()->json([
            'message' => 'Product added to cart',
        ]);
    }
}
