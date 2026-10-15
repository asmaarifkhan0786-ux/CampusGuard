<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(
        Request $request,
        Closure $next,
        string $role
    ): Response {
        // User login nahi hai
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Logged-in user ka actual database role
        $userRole = auth()->user()->role;

        // Required role se match nahi karta
        if ($userRole !== $role) {
            abort(403, 'You are not authorized to access this page.');
        }

        // Authorized user
        return $next($request);
    }
}