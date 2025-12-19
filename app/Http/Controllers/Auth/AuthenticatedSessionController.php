<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Attempt to authenticate
            $request->authenticate();

            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            $user = auth()->user();

            $roleMap = [
                'admin'          => 'Administrator',
                'member'         => 'SWISA Member',
                'support_staff'  => 'Support Staff',
            ];

            $rawRole = is_object($user->role) ? $user->role->role_name : $user->role;
            $displayRole = $roleMap[$rawRole] ?? ucfirst($rawRole ?? 'Member');

            Log::create([
                'user_id'   => $user->id,
                'user_name' => trim($user->first_name . ' ' . $user->last_name) ?: $user->email,
                'role'      => $displayRole,
                'activity'  => 'Logged In',
                'ip_address'=> $request->ip(),
                'status'    => 'success',
                'activity_timestamp' => now(),
                'details'   => null,
            ]);

            return redirect()->intended(route('dashboard'));

        } catch (ValidationException $e) {
            // ✅ Log failed login attempt (user not authenticated yet)
            Log::create([
                'user_id'   => null,
                'user_name' => $request->email ?? 'Unknown',
                'role'      => null,
                'activity'  => 'Login Attempt',
                'ip_address'=> $request->ip(),
                'status'    => 'failed',
                'activity_timestamp' => now(),
                'details'   => ['error' => 'Invalid credentials'],
            ]);

            throw $e; // continue with Laravel's normal validation error handling
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (auth()->check()) {
            $user = auth()->user();

            $roleMap = [
                'admin'          => 'Administrator',
                'member'         => 'SWISA Member',
                'officer'        => 'System Officer',
                'support_staff'  => 'Support Staff',
            ];

            $rawRole = is_object($user->role) ? $user->role->role_name : $user->role;
            $displayRole = $roleMap[$rawRole] ?? ucfirst($rawRole ?? 'Member');

            Log::create([
                'user_id'   => $user->id,
                'user_name' => trim($user->first_name . ' ' . $user->last_name) ?: $user->email,
                'role'      => $displayRole,
                'activity'  => 'Logged Out',
                'ip_address'=> $request->ip(),
                'status'    => 'success',
                'activity_timestamp' => now(),
                'details'   => null,
            ]);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
