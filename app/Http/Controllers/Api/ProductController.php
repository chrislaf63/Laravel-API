<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenApi\Annotations;

class ProductController extends Controller
{

    /**
     * @OA\Get(path="/api/v1/products",
     *     tags={"Products"},
     *     summary="Get all products",
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     @OA\Response( response=404, description="Not Found"),
     *     @OA\Response( response=422, description="Unprocessable Entity"),
     *     )
     */

    public function index()
    {
        $products = Product::all();
//        $categories = Categorie::select('categorie')->get();
        $products->load(['categories' => function ($query) {
            $query->select('categories.id', 'categories.categorie');
        }]);

        return response()->json([
            'status' => true,
            'products' => $products,
        ]);
    }

    /**
     * @OA\Post(
     *   path="/api/v1/products",
     *     tags={"Products"},
     *     summary="Create a product",
     *     @OA\Parameter(name="name", in="query"),
     *     @OA\Parameter(name="description", in="query"),
     *     @OA\Parameter(name="price", in="query"),
     *     @OA\Parameter(name="stock", in="query"),
     *     @OA\Parameter(name="categorie", in="query"),
     *     @OA\Parameter(name="image", in="query"),
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     @OA\Response( response=404, description="Not Found"),
     *     @OA\Response( response=422, description="Unprocessable Entity"),
     *     )
     */

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if ($request->hasFile('image')) {
            $photoName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('photos'), $photoName);
            $product->image = $photoName;
        }
        $decode = json_decode($request->categorie, true);
//        dd($decode);
        $request->merge(['categorie' => $decode]);
        $categories = Categorie::select('id', 'categorie')->get();
        foreach ($categories as $category):
            foreach ($request->categorie as $cat) {
                if ($category->categorie == $cat):
                    $product->save();
                    $product->categories()->attach($category->id);
                endif;
            }
        endforeach;
    }


    /**
     * @OA\Put(
     *     path="/api/v1/products/{id}",
     *     tags={"Products"},
     *     summary="Update a product",
     *     @OA\Parameter(name="id", description="Product id", in="path", required=true),
     *     @OA\Parameter(name="name", in="query"),
     *     @OA\Parameter(name="description", in="query"),
     *     @OA\Parameter(name="price", in="query"),
     *     @OA\Parameter(name="stock", in="query"),
     *     @OA\Parameter(name="categorie", in="query"),
     *     @OA\Parameter(name="image", in="query"),
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     @OA\Response( response=404, description="Not Found"),
     *     @OA\Response( response=422, description="Unprocessable Entity"),
     *     )
     */

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $array = [];
        if (isset($request->categorie)) {
            $decode = json_decode($request->categorie, true);
            $request->merge(['categorie' => $decode]);
            $categories = Categorie::select('id', 'categorie')->get();
            foreach ($categories as $category):
                foreach ($request->categorie as $cat) {
                    if ($category->categorie == $cat):
                        array_push($array, $category->id);
                    endif;
                }
            endforeach;
            $product->update($request->all());
            $product->categories()->sync($array);
        } else {
            $product->update($request->all());
        }
        if ($request->hasFile('image')) {
            $photoName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('photos'), $photoName);
            $product->image = $photoName;
        };
        $product->update();
    }

    /**
     * @OA\delete(
     *     path="/api/v1/products/{id}",
     *     tags={"Products"},
     *     summary="Delete a product",
     *     @OA\Parameter(name="id", description="Product id", in="path", required=true),
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     @OA\Response( response=404, description="Not Found"),
     *     @OA\Response( response=422, description="Unprocessable Entity"),
     *     )
     */

       public function destroy(string $id)
    {
        $product = Product::find($id);
        Storage::delete($product->image);
        $product->delete();
        return response(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/products/{id}",
     *     tags={"Products"},
     *     summary="Get a product",
     *     @OA\Parameter(name="id", description="Product id", in="path", required=true),
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     @OA\Response( response=404, description="Not Found"),
     *     @OA\Response( response=422, description="Unprocessable Entity"),
     *     )
     */

    public function show($id)
    {
        $product = Product::find($id);
        $product->load(['categories' => function ($query) {
            $query->select('categories.id', 'categories.categorie');
        }]);
        return response()->json([
            'status' => true,
            'product' => $product,
        ]);
    }
}
