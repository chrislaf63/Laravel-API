<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if($request->hasFile('image')) {
            $photoName = time().'.'.$request->image->extension();
            $request->image->move(public_path('photos'), $photoName);
            $product->image = $photoName;
        }
        $decode = json_decode($request->categorie, true);
//        dd($decode);
        $request->merge(['categorie' => $decode]);
        $categories = Categorie::select('id', 'categorie')->get();
        foreach($categories as $category):
            foreach($request->categorie as $cat){
            if ($category->categorie == $cat):
                $product->save();
                $product->categories()->attach($category->id);
            endif;
            }
        endforeach;
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if($request->hasFile('image')) {
            $photoName = time().'.'.$request->image->extension();
            $request->image->move(public_path('photos'), $photoName);
            $product->image = $photoName;
        }
        $product->update($request->all());
        $product->categories()->sync($request->categorie);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return response(null, 204);
    }


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
