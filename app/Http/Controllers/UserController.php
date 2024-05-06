<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users-manage', compact('users'));
    }

    public function create()
    {
        return view('user-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:255',
            'email' =>'required',
            'password' => ['required','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', 'confirmed'],
            'password_confirmation' => 'required|same:password'
        ]);
        User::create($request->all());
        $users = User::all();
        return view('users-manage', compact('users'));
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user-edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $users = User::all();
        return view('users-manage', compact('users'));
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        $users = User::all();
        return view('users-manage', compact('users'));
    }
}
