<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AuthController
 *
 * Handles user login and logout.
 * We build our own simple auth instead of Laravel Breeze
 * so it's easier to understand for viva.
 *
 * MVC role: Controller — receives HTTP request, validates,
 * calls Auth::attempt(), then returns a View or Redirect.
 */
class AuthController extends Controller
{
    /**
     * Show the login form.
     * GET /login
     */
    public function showLogin()
    {
        // If already logged in, redirect to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login form submission.
     * POST /login
     */
    public function login(Request $request)
    {
        // Step 1: Validate the incoming request data
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        // Step 2: Check "Remember Me" checkbox
        $remember = $request->boolean('remember');

        // Step 3: Attempt login using Laravel's built-in Auth system
        // Auth::attempt() checks email+password against the database
        // Laravel automatically hashes and compares passwords securely
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'is_active' => true], $remember)) {

            // Step 4: Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            $user = Auth::user();

            // Step 5: Redirect based on role
            return redirect()->route('dashboard')
                ->with('success', 'Welcome back, ' . $user->name . '!');
        }

        // Step 6: Login failed — return error
        // We use withErrors() so the error appears in the form
        return back()->withErrors([
            'email' => 'These credentials do not match our records, or your account is inactive.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Log the user out.
     * POST /logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}
