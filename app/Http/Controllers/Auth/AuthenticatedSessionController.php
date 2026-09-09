<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // DESTROY ANY EXISTING SESSION BEFORE PROCESSING LOGIN
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Validate credentials
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // REGENERATE SESSION ONCE AUTHENTICATED
        $request->session()->regenerate();

        $user = Auth::user();

        // Role-based redirection
        if ($user->hasRole('Super Admin')) {
            return redirect()->route('overview_tickets.index');
        } elseif ($user->hasRole('Client')) {
            return redirect()->route('myrequested_tickets.index');
        } elseif ($user->hasAnyRole(['ICTD', 'ICTS', 'ICTS Admin'])) {
            return redirect()->route('tickets.index');    
        } elseif ($user->hasAnyRole(['DPO', 'DBRT'])) {
            return redirect()->route('databreach.index');
        }

        // Default fallback (Avoid redirecting authenticated users to 'login')
        return redirect('/');
    }

    /**
     * Destroy an authenticated session (logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}