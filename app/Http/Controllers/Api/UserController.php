<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Annotations;


class UserController extends Controller
{
    use HasApiTokens;

    /**
     * @OA\Get(
     *     path="/api/v1/user",
     *     tags={"Users"},
     *     summary="Get all users",
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
        $users = User::all();
        return response()->json([
           $users
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user/{id}",
     *     tags={"Users"},
     *     summary="Get one user",
     *     @OA\Parameter(name="id", description="User id", in="path", required=true),
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
        $user = User::find($id);
        return response()->json([
            $user
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user",
     *     tags={"Users"},
     *     summary="Create a new user",
     *     @OA\Parameter(name="name", in="query", required=true),
     *     @OA\Parameter(name="email", in="query", required=true),
     *     @OA\Parameter(name="password", in="query", required=true),
     *     @OA\Parameter(name="password_confirmation", in="query", required=true),
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
            'name' =>'required|max:255',
            'email' =>'required',
            'password' => ['required','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', 'confirmed'],
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create($request->all());
        $token = $user->createToken('authToken',['*']);
        return response()->json(['token' => $token->plainTextToken]);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/user/{id}",
     *     tags={"Users"},
     *     summary="Update a user",
     *     @OA\Parameter(name="id", description="User id", in="path", required=true),
     *     @OA\Parameter(name="name", in="query", required=true),
     *     @OA\Parameter(name="email", in="query", required=true),
     *     @OA\Parameter(name="password", in="query", required=true),
     *     @OA\Parameter(name="password_confirmation", in="query", required=true),
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
        $user = User::find($id);
        $user->update($request->all());
    }

    /**
     * @OA\delete(
     *     path="/api/v1/user/{id}",
     *     tags={"Users"},
     *     summary="Delete a user",
     *     @OA\Parameter(name="id", description="User id", in="path", required=true),
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     )
     */

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response(null, 204);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/login",
     *     tags={"Users"},
     *     summary="Login a user",
     *     @OA\Parameter(name="email", in="query", required=true),
     *     @OA\Parameter(name="password", in="query", required=true),
     *     @OA\Response( response=200, description="Success"),
     *     @OA\Response( response=401, description="Unauthorized"),
     *     @OA\Response( response=403, description="Forbidden"),
     *     @OA\Response( response=500, description="Internal Server Error"),
     *     )
     */

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
