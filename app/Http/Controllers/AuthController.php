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
    | Student Login Page
    |--------------------------------------------------------------------------
    */

    public function studentLogin()
    {
        return redirect()->route('login', [
            'type' => 'student'
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Admin Login Page
    |--------------------------------------------------------------------------
    */

    public function adminLogin()
    {
        return redirect()->route('login', [
            'type' => 'admin'
        ]);
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
        | Find User
        |--------------------------------------------------------------------------
        */

        $user = User::where('email', $credentials['email'])->first();


        /*
        |--------------------------------------------------------------------------
        | Check Email / Password
        |--------------------------------------------------------------------------
        */

        if (!$user || !Hash::check($credentials['password'], $user->password)) {

            return back()
                ->withInput($request->only('email'))
                ->with('loginType', $loginType)
                ->withErrors([
                    'email' => 'The email or password is incorrect.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ADMIN LOGIN
        |--------------------------------------------------------------------------
        |
        | Only these four authorized people can enter the
        | Admin Dashboard.
        |
        */

        if ($loginType === 'admin') {

            $adminNames = [
                'Mohid',
                'Laiba',
                'Asma',
                'Bushra',
                'waleed',
            ];

            $isAuthorizedAdmin = false;

            foreach ($adminNames as $adminName) {

                if (
                    strcasecmp(
                        trim($user->name),
                        trim($adminName)
                    ) === 0
                    ||
                    stripos(
                        trim($user->name),
                        trim($adminName)
                    ) !== false
                ) {
                    $isAuthorizedAdmin = true;
                    break;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Admin Not Authorized
            |--------------------------------------------------------------------------
            */

            if (!$isAuthorizedAdmin) {

                return back()
                    ->withInput($request->only('email'))
                    ->with('loginType', 'admin')
                    ->withErrors([
                        'email' =>
                            'Admin access denied. This account is not authorized for the CampusGuard Admin Panel.',
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Login Authorized Admin
            |--------------------------------------------------------------------------
            */

            Auth::login($user, $request->boolean('remember'));

            $request->session()->regenerate();

            $request->session()->put('user_role', 'admin');

            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Welcome to the CampusGuard Admin Dashboard.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | STUDENT LOGIN
        |--------------------------------------------------------------------------
        */

        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        $request->session()->put('user_role', 'student');


        /*
        |--------------------------------------------------------------------------
        | Student goes directly to Report Incident
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('emergency-reports.create')
            ->with(
                'success',
                'Welcome to CampusGuard. You can now report an emergency incident.'
            );
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


        /*
        |--------------------------------------------------------------------------
        | Every newly registered account is a Student
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);


        Auth::login($user);

        $request->session()->regenerate();

        $request->session()->put('user_role', 'student');


        /*
        |--------------------------------------------------------------------------
        | New Student goes to Report Incident
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('emergency-reports.create')
            ->with(
                'success',
                'Account created successfully. You can now report an emergency incident.'
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