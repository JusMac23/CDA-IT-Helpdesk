<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Schema;

class OAuthGoogleController extends Controller
{
    // Redirect to Google OAuth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists by email
            $user = User::where('email', $googleUser->getEmail())->first();

            // Get the "User" role by name and capture its ID
            try {
                $userRole = Role::where('name', 'User')->first();
                
                if (!$userRole) {
                    // Create User role if it doesn't exist
                    $userRole = Role::create(['name' => 'User']);
                    
                    // Log the creation of a new role
                    \Log::info('Created new User role with ID: ' . $userRole->id);
                }
                
                // Set the role value to the role ID
                $roleValue = $userRole->id;
                
            } catch (\Exception $roleException) {
                \Log::error('Role handling failed: ' . $roleException->getMessage());
                return redirect('/login')->with('error', 'Role configuration error: ' . $roleException->getMessage());
            }

            if ($user) {
                // Update google_id if the column exists and is missing
                if (Schema::hasColumn('users', 'google_id') && !$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->save();
                }
            } else {
                // Prepare user data
                $userData = [
                    'name'              => $googleUser->getName(),
                    'email'             => $googleUser->getEmail(),
                    'password'          => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                    'role'              => $roleValue, // Use the role ID here
                ];
                
                // Add google_id only if the column exists
                if (Schema::hasColumn('users', 'google_id')) {
                    $userData['google_id'] = $googleUser->getId();
                }
                
                // Create new user
                $user = User::create($userData);
            }
            
            // Ensure user has a role assigned (for Spatie Permission)
            if (!$user->hasAnyRole()) {
                try {
                    $user->assignRole($userRole);
                    \Log::info('Assigned User role to user: ' . $user->email);
                } catch (\Exception $assignException) {
                    \Log::error('Role assignment failed: ' . $assignException->getMessage());
                    // Continue with login even if role assignment fails
                }
            }

            // Login and regenerate session
            Auth::guard('web')->login($user);
            $request->session()->regenerate();

            // Redirect based on role
            if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
                return redirect()->route('dashboard');
            } elseif ($user->hasRole('User')) {
                return redirect()->route('myrequested_tickets.index');
            }

            // Fallback if no role
            return redirect()->route('login')->with('error', 'No role assigned to this account.');

        } catch (\Exception $e) {
            \Log::error('Google authentication failed: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }
}