<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('id', 'DESC')->get();
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->product_name  = $request->product_name;
        $product->slug          = str::slug($request->product_name);
        $product->price         = $request->price;
        $product->discount_price = $request->discount_price;
        $product->status       = $request->status;

        if ($request->hasFile('thumbnail')) {
            $location = '/uploads/product/';
            $image = $request->file('thumbnail');
            $image = saveImage($image, $location);
            $product->thumbnail = $image;
        }
        $product->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->product_name  = $request->product_name;
        $product->slug          = str::slug($request->product_name);
        $product->price         = $request->price;
        $product->discount_price = $request->discount_price;
        $product->status       = $request->status;

        if ($request->hasFile('thumbnail')) {
            deleteImage($product->thumbnail);
            $location = '/uploads/product/';
            $image = $request->file('thumbnail');
            $image = saveImage($image, $location);
            $product->thumbnail = $image;
        }

        $product->save();
        return response()->json([
           'message' => 'Product updated successfully',
           'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        deleteImage($product->thumbnail);
        $product->delete();
        return response()->json([
           'message' => 'Product deleted successfully'
        ], 200);
    }
}
