<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $field = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' =>  Hash::make($field['password'])
        ]);
        $token = $user->createToken($request->name);
        return [
            'token' => $token->plainTextToken,
            'user' => $user
        ];
    }
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user|| !Hash::check($request->password, $user->password)){
            return [
                'message' => 'Unauthorized'
            ];
        }
        $token = $user->createToken($user->name);
        return [
            'token' => $token->plainTextToken,
            'user' => $user
        ];
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
