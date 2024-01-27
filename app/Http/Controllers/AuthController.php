<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup()
    {
        return view('signup');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_type' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'User created successfully.');
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = request()->only('email', 'password');

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();
            return redirect()->route('listings.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
