<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Authenticated'], 200);
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function register(){
        return view('register');
    }

    public function doRegister(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string'],
        ]);

        try {
            // Hash the password using bcrypt
            $validatedData['password'] = bcrypt($validatedData['password']);

            // Create the user
            $user = User::create($validatedData);

            // Automatically log in the user after registration
            Auth::login($user);

            // Regenerate session
            $request->session()->regenerate();

            // Return success response
            // return response()->json(['success' => true, 'message' => 'Registration successful', 'user' => $user], 201);
            return redirect('/')->with('success', 'Data berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Return error response in case of any exception
            // return response()->json(['error' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
