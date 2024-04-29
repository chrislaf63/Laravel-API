<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => true,
            'products' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
           'status' => true,
            'products' => $user
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
    }
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response(null, 204);
    }
}
