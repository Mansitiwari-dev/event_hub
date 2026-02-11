<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the registration form with role selection
     */
    public function show()
    {
        $roles = Role::where('name', '!=', 'admin')->get(['id', 'name', 'display_name']);
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle registration form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'is_active' => true,
        ]);

        // Log the user in
        Auth::login($user);

        // Get the role name for redirection
        $role = Role::findOrFail($validated['role_id'])->name;
        
        // Map role names to their corresponding dashboard routes
        $dashboardRoutes = [
            'admin' => 'dashboard.admin',
            'manager' => 'dashboard.manager',
            'vendor' => 'dashboard.vendor',
            'customer' => 'dashboard.customer',
            'organizer' => 'dashboard.organizer'
        ];
        
        $route = $dashboardRoutes[strtolower($role)] ?? 'home';
        
        return redirect()->route($route)
            ->with('success', 'Your account has been created successfully!');
    }

    /**
     * Get the redirect path based on user role
     */
    protected function redirectTo()
    {
        $role = strtolower(auth()->user()->role->name);
        
        $dashboardRoutes = [
            'admin' => 'dashboard.admin',
            'manager' => 'dashboard.manager',
            'vendor' => 'dashboard.vendor',
            'customer' => 'dashboard.customer',
            'organizer' => 'dashboard.organizer'
        ];
        
        return $dashboardRoutes[$role] ?? 'home';
    }
}