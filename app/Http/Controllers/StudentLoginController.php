<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentLoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            if (Auth::user()->role === 'student') {
                return redirect()->route('emergency-reports.create');
            }
        }

        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (
            !$user ||
            !Hash::check($credentials['password'], $user->password)
        ) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'The email or password is incorrect.',
                ]);
        }

        if ($user->role !== 'student') {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'This account is not registered as a student.',
                ]);
        }

        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        $request->session()->put('user_role', 'student');

        return redirect()
            ->route('emergency-reports.create')
            ->with(
                'success',
                'Welcome to CampusGuard. You can now report an emergency incident.'
            );
    }
}