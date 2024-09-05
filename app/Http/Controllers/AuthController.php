<?php

namespace App\Http\Controllers;

use App\Jobs\SendResetLinkJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

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
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // return $status === Password::RESET_LINK_SENT
        //     ? back()->with(['status' => __($status)])
        //     : back()->withErrors(['email' => __($status)]);

        // Cara Kedua

        // $user = User::where('email', $request->email)->first();
        // if ($user) {
        //     // Ini job-nya
        //     SendResetPasswordEmail::dispatch($user);
        //     return back()->with('status', 'Password reset link has been sent to your email address.');
        // }

        // return back()->withErrors(['email' => 'We couldn’t find a user with that email address.']);

        // cara ketiga (berhasil)
        // Dispatch the Job to send the reset link email asynchronously
        $user = User::where('email', $request->email)->first();

        // Dispatch the job to send the reset link
        // SendResetLinkJob::dispatch($user);
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
                    'password' => Hash::make($password),
                ])->save();

                // Optionally, log the user in after password reset
                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('halamanUtamaNih')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}
