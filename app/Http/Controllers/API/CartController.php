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
        $rowId = $request->rowId;
        $qty = Cart::get($rowId)->qty;
        Cart::update($rowId, $qty + 1);
        return response()->json(['message' => 'Cart updated successfully'], 200);
    }

    //decrement quantity and if quantity is less then 0 remove from cart
    public function decrementQuantity(Request $request)
    {
        $rowId = $request->rowId;
        $qty = Cart::get($rowId)->qty;
        if ($qty <= 1) {
            Cart::remove($rowId);
        } else {
            Cart::update($rowId, $qty - 1);
        }
        return response()->json(['message' => 'Cart updated successfully'], 200);
    }
}
