<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController  extends Controller
{
    // REGISTER 
    public function register(Request $request){
        $request -> validate([
            'name' => 'required|string|min:3|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // return response
        return response()->json([
            'message' => 'User registered successfully',
        ], 201);
    }

    // LOGIN
    public function login(Request $request){
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request ->only ('email', 'password'))){
            return response()->json(
                [
                    'message' => 'Invalid credentials',
                ], 401
                );
            }
                $token = Auth::user()->createToken('API Token')->plainTextToken;
                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                ]);
            }


    // user info
    public function userInfo(Request $request){
        return response()->json([
           $request->user()
        ]);
    }

    //logout
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
}
}