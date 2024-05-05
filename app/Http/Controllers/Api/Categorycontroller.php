<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class Categorycontroller extends Controller
{

    /**
     * @OA\Get(path="/api/v1/category",
     *     tags={"Categories"},
     *     summary="Get all categories",
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
        $categories = Categorie::all();

        return response()->json([
            'status' => true,
            'categories' => $categories,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/category",
     *     tags={"Categories"},
     *     summary="Create a category",
     *     @OA\Parameter(name="categorie", in="query"),
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
        $request->validate([
            'categorie' =>'required|max:255',
        ]);
        Categorie::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/v1/category/{id}",
     *     tags={"Categories"},
     *     summary="Get one category",
     *     @OA\Parameter(name="id", in="path", required=true),
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     @OA\Response( response=404, description="Not Found"),
     *     @OA\Response( response=422, description="Unprocessable Entity"),
     *     )
     */

    public function show(string $id)
    {
        $categorie = Categorie::find($id);
        return response()->json([
            'status' => true,
            'categories' => $categorie,
        ]);

    }

    /**
     * @OA\Put(
     *     path="/api/v1/category/{id}",
     *     tags={"Categories"},
     *     summary="Update a category",
     *     @OA\Parameter(name="id", in="path", required=true),
     *     @OA\Parameter(name="categorie", in="query"),
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
        $categorie = Categorie::find($id);
        $categorie->update($request->all());
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/category/{id}",
     *     tags={"Categories"},
     *     summary="Delete a category",
     *     @OA\Parameter(name="id", in="path", required=true),
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
        $categorie = Categorie::find($id);
        $categorie->delete();
        return response(null, 204);
    }
}
