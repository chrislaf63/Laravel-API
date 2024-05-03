<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens;

    public function index()
    {
        $users = User::all();
        return response()->json([
           $users
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:255',
            'email' =>'required',
            'password' => ['required','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', 'confirmed'],
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create($request->all());
        $token = $user->createToken('authToken',['*']);
        return response()->json(['token' => $token->plainTextToken]);
    }
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response(null, 204);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>'required|email',
            'password' => 'required'
            ]);

        if($validator->fails()){
            return response()->json([
               'status' => false,
               'message' => $validator->errors()
            ]);
        }

        $validated = $validator->validated();
        if(Auth::attempt($validated)){
            if(auth('sanctum')->check()){
                auth()->user()->tokens()->delete();
            }
        }
        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('authToken',['*'])
            ->plainTextToken;
        return response()->json(['message' => 'Log successfully',
            'token' => $token,
            'user' => $user
        ]);
    }
}
