<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login()
    {
        return response()->json([
            'message' => 'Hello World'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            $token = auth()->user()->createToken('authToken');
            return response()->json([
                'status' => 200,
                'message' => 'Login Successful',
                'result' => [
                    'user_id' => auth()->user()->id,
                    'access_token' => $token->plainTextToken,
                    'token_type' => 'Bearer',
                    'role_type' => auth()->user()->role_type,
                    'expires_at' => now()->addSeconds(30)->format('Y-m-d H:i:s'),
                ]
            ]);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
