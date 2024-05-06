<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;


class Categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('categories', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categorie' =>'required|max:255',
        ]);
        Categorie::create($request->all());
        $categories = Categorie::all();
        return view('categories', compact('categories'));
    }

    public function edit(string $id)
    {
        $category = Categorie::find($id);
        return view('category-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Categorie::find($id);
        $category->update($request->all());
        $categories = Categorie::all();
        return view('categories', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();
        $categories = Categorie::all();
        return view('categories' , compact('categories'));
    }
}
