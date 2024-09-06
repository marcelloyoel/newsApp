<?php

namespace App\Http\Controllers;

use App\Jobs\SendResetLinkJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string'],
        ]);

        try {
            $validatedData['password'] = bcrypt($validatedData['password']);
            $user = User::create($validatedData);
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Berhasil Membuat Akun!');

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

    // Show Forgot Password Form
    public function showForgotPasswordForm()
    {
        return view('forget.forgot-password');
    }

    // Handle Sending Password Reset Link
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $user = User::where('email', $request->email)->first();
        dispatch(new SendResetLinkJob($user));
        return back()->with(['status' => 'We have emailed your password reset link!']);
    }

    // Show Reset Password Form
    public function showResetPasswordForm($token)
    {
        return view('forget.reset-password', ['token' => $token]);
    }

    // Handle Password Reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();

                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('halamanUtamaNih')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}
