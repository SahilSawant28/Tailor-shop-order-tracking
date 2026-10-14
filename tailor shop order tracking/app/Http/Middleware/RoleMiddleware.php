<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * RoleMiddleware
 *
 * Protects routes based on user role.
 * Usage in routes:  ->middleware('role:admin')
 *                   ->middleware('role:admin,staff')
 *
 * How it works:
 * 1. Check if user is logged in (auth check is done by 'auth' middleware before this)
 * 2. Check if user's role is in the allowed roles list
 * 3. If not allowed → redirect to dashboard with error message
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  One or more allowed roles (e.g., 'admin', 'staff')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // If user is not logged in, redirect to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // If user account is deactivated
        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Your account has been deactivated. Contact the administrator.']);
        }

        // Check if user's role is in the list of allowed roles
        if (!in_array($user->role, $roles)) {
            // Admin can see everything; staff gets restricted
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
