<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);



        $user = User::create([
            'name' => $attrs['name'],
            'phone' => $attrs['phone'],
            'email' => $attrs['email'],
            'password' => bcrypt($attrs['password'])
        ]);


        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    public function login (Request $request)
    {
        $attrs = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);



        if(!Auth::attempt($attrs)){
            return response([
                'message' => 'Invalid email or password'
            ], 403);
        }


        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function logout () {
        auth()->user()->tokens()->delete();

        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function user() {
        return response([
            'user' => Auth::user(), 200
        ]);
    }
}
