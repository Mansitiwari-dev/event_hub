<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form
     */
    public function create(Request $request): View
    {
        $role = $request->query('role', 'customer');
        return view('auth.register', compact('role'));
    }

    /**
     * Handle registration
     */
    public function store(Request $request): RedirectResponse
    {
        $role = $request->input('role', 'customer');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $roleRecord = Role::where('name', $role)->first()
            ?? Role::where('name', 'customer')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleRecord->id,
            'is_active' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isOrganizer()) {
            return redirect()->route('manager.dashboard');
        }

        if ($user->isVendor()) {
            return redirect()->route('vendor.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }
}
