<?php

namespace App\Http\Controllers;


use App\Http\Resources\ProductResource;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Categorie::all();
        return view('products', compact('products'));
    }

    public function create(){
        return view('create-product', [
            'title' => 'Ajouter un produit',
            'categories' => Categorie::select('id', 'categorie')->get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

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
        $product->save();
        $product->categories()->attach($request->categories);

        return redirect()->route('products')
            ->with('success','Post created successfully.');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $idCategories = array_column($product->categories->all(), 'id');
        return view('edit-product', compact('product'), [
            'title' => 'Modifier un post',
            'categories' => Categorie::select('id', 'categorie')->get(),
            'idCategories' => $idCategories,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'stock' =>'required',
            ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        if($request->hasFile('image')) {
            $photoName = time().'.'.$request->image->extension();
            $request->image->move(public_path('photos'), $photoName);
            $product->image = $photoName;
        }
        $product->update();
        $product->categories()->sync($request->categories);

        return redirect()->route('products')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products')
            ->with('success', 'Product deleted successfully');
    }


    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'status' => true,
            'product' => $product->load('categorie'),
        ]);
    }
}
