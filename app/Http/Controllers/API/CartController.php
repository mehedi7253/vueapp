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
        return response()->json(
            [
                'cartItems' => Cart::content(),
                'totalPrice' => Cart::total(),
            ]
        );
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        Cart::add([
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
        return response()->json("added to cart");
    }

    public function remove(Request $request)
    {
        Cart::remove($request->rowId);
        return response()->json("removed from cart");
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'rowId' => 'required|string',
            'quantity' => 'required|integer|min=1'
        ]);
        Cart::update($request->rowId, $request->quantity);
        return response()->json(['message' => 'Cart updated successfully'], 200);
    }
}
