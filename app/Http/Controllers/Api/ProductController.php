<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => true,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, 204);
    }


    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
           'status' => true,
            'product' => $product
        ]);
    }
}
