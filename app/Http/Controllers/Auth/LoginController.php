<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request
     */
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Make sure the role relationship is loaded
            $user->load('role');
            
            // Check if user has a role
            if (!$user->role) {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'Your account does not have a valid role assigned.',
                ]);
            }

            // Get the role name in lowercase for case-insensitive comparison
            $role = strtolower($user->role->name);

            // Redirect based on role
            if ($role === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif ($role === 'event_manager') {
                return redirect()->route('dashboard.event_manager');
            } elseif ($role === 'venue_manager') {
                return redirect()->route('dashboard.venue_manager');
            } elseif ($role === 'vendor') {
                return redirect()->route('dashboard.vendor');
            } elseif ($role === 'customer' || $role === 'user') {
                return redirect()->route('dashboard.customer');
            }

            // Fallback if role not recognized
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'Your account role is not recognized.',
            ]);
        }

        // Login failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
