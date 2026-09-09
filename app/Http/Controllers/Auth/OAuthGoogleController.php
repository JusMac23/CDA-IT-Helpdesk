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

            if ($user) {
                // If existing user doesn't have a google_id, link it now
                if (Schema::hasColumn('users', 'google_id') && !$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->save();
                }
            } else {
                // Get the "User" role by name and capture its ID
                try {
                    $userRole = Role::where('name', 'Client')->first();
                    
                    if (!$userRole) {
                        // Create User role if it doesn't exist
                        $userRole = Role::create(['name' => 'Client']);
                        
                        // Log the creation of a new role
                        \Log::info('Created new User role with ID: ' . $userRole->id);
                    }
                    
                    // Set the role value to the role ID
                    $roleValue = $userRole->id;
                    
                } catch (\Exception $roleException) {
                    \Log::error('Role handling failed: ' . $roleException->getMessage());
                    return redirect('/login')->with('error', 'Role configuration error: ' . $roleException->getMessage());
                }

                // Prepare user data
                $userData = [
                    'name'              => $googleUser->getName(),
                    'email'             => $googleUser->getEmail(),
                    'password'          => Hash::make($googleUser->getEmail()),
                    'email_verified_at' => now(),
                    'role'              => $roleValue, 
                    'region'            => $request->input('region', null), 
                ];
                
                // Add google_id only if the column exists
                if (Schema::hasColumn('users', 'google_id')) {
                    $userData['google_id'] = $googleUser->getId();
                }
                
                // Create new user
                $user = User::create($userData);
                
                // Ensure user has a role assigned (for Spatie Permission)
                if (!$user->hasAnyRole()) {
                    try {
                        $user->assignRole($userRole);
                        \Log::info('Assigned User role to user: ' . $user->email);
                    } catch (\Exception $assignException) {
                        \Log::error('Role assignment failed: ' . $assignException->getMessage());
                    }
                }
            }
            
            // ----------------------------------------------------
            // LOGIN USER
            // ----------------------------------------------------
            Auth::guard('web')->login($user);
            $request->session()->regenerate();

            $roles = $user->getRoleNames()->implode(', ');
            \Log::info("User {$user->email} logged in with roles: {$roles}");

            // ----------------------------------------------------
            // ROLE-BASED REDIRECTION
            // ----------------------------------------------------
            if ($user->hasRole('Super Admin')) {
                return redirect()->route('overview_tickets.index');
            } elseif ($user->hasRole('Client')) {
                return redirect()->route('myrequested_tickets.index');
            } elseif ($user->hasAnyRole(['ICTD', 'ICTS', 'ICTS Admin'])) {
                return redirect()->route('tickets.index');
            } elseif ($user->hasAnyRole(['DPO', 'DBRT'])) {
                return redirect()->route('databreach.index');
            }

            // Fallback for authenticated Google users with no assigned roles
            return redirect('/');

        } catch (\Exception $e) {
            \Log::error('Google authentication failed: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }
}