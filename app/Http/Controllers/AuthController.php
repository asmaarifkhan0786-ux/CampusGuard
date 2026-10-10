<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Login
    |--------------------------------------------------------------------------
    */

    public function showLogin(Request $request)
    {
        $loginType = $request->query('type', 'student');

        if (!in_array($loginType, ['student', 'admin'])) {
            $loginType = 'student';
        }

        return view('auth.login', compact('loginType'));
    }


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $loginType = $request->input('login_type', 'student');

        if (!in_array($loginType, ['student', 'admin'])) {
            $loginType = 'student';
        }

        $credentials = $request->validate([
            'email' => [
                'required',
                'email'
            ],

            'password' => [
                'required'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Check Login
        |--------------------------------------------------------------------------
        */

        if (Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ],
            $request->boolean('remember')
        )) {

            $request->session()->regenerate();

            return redirect()
                ->intended(route('dashboard'))
                ->with(
                    'success',
                    'Welcome back! You are successfully logged in.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Login Failed
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput($request->only('email'))
            ->with('loginType', $loginType)
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Register Page
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | Register
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);


        Auth::login($user);

        $request->session()->regenerate();


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Account created successfully. Welcome to CampusGuard!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()
            ->route('home')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Forgot Password Page
    |--------------------------------------------------------------------------
    */

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }


    /*
    |--------------------------------------------------------------------------
    | Forgot Password
    |--------------------------------------------------------------------------
    */

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email'
            ],
        ]);


        $user = User::where(
            'email',
            $request->email
        )->first();


        if (!$user) {

            return back()->withErrors([
                'email' => 'No account was found with this email address.',
            ]);
        }


        return back()->with(
            'success',
            'Your account was found. Please contact the system administrator to reset your password.'
        );
    }
}