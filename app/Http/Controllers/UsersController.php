<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

use Carbon\Carbon;

use App\Models\User;
use App\Models\RegionEmail;
use App\Models\DatabreachTeam;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserCredentialsMail;

class UsersController extends Controller
{
    // Display All User
    public function index(Request $request)
    {
        $query = User::query()->with(['roles.permissions'])
            ->select('users.*')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->distinct(); // Prevent duplicate rows when users have multiple roles

        $region = RegionEmail::pluck('region')->toArray();    

        if ($request->filled('search_query')) {
            $search = $request->search_query;

            $query->where(function ($q) use ($search) {
                $q->where('users.id', 'like', "%{$search}%")
                    ->orWhere('users.name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.region', 'like', "%{$search}%")
                    ->orWhere('users.contact_number', 'like', "%{$search}%")
                    ->orWhere('users.created_at', 'like', "%{$search}%")
                    ->orWhere('users.updated_at', 'like', "%{$search}%");
            })
            ->orWhereHas('roles', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $query->orderBy('users.id', 'asc'); // Switched ordering to users.id to prevent issues with distinct() and left joins

        if (auth()->user()->hasRole('Super Admin')) {
            $roles = Role::all(); 
        } else {
            $roles = Role::where('name', '!=', 'Super Admin')->get(); 
        }

        $users = $query->paginate(10)->appends($request->only('search_query'));

        return view('users.index', compact('users', 'roles', 'region'));
    }

    // Add New User
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'region'         => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:15',
            'password'       => 'required|string|min:8|confirmed',
            'roles'          => 'required|array', // Accept multiple roles
            'roles.*'        => 'exists:roles,id',
        ]);

        // Check if email or contact number already exists
        $exists = User::where('email', $request->email)
            ->when($request->contact_number, function($query) use ($request) {
                $query->orWhere('contact_number', $request->contact_number);
            })
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Email or contact number already exists.');
        }

        // Get the requested roles
        $roles = Role::whereIn('id', $validated['roles'])->get();
        $roleNames = $roles->pluck('name')->toArray();

        // Super Admin checks
        if (in_array('Super Admin', $roleNames)) {
            $superAdminExists = User::whereHas('roles', function ($q) {
                $q->where('name', 'Super Admin');
            })->exists();

            if ($superAdminExists) {
                return back()->withInput()->with('error', 'Super Admin role already exist.');
            }

            if (!auth()->user()->hasRole('Super Admin')) {
                return back()->withInput()->with('error', 'You are not authorized to assign Super Admin role.');
            }
        }

        // DPO checks
        if (in_array('DPO', $roleNames)) {
            $dpoExists = User::whereHas('roles', function ($q) {
                $q->where('name', 'DPO');
            })->exists();

            if ($dpoExists) {
                return back()->withInput()->with('error', 'DPO role already exist.');
            }
        }

        $user = User::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'region'         => $validated['region'],
            'contact_number' => $validated['contact_number'],
            'password'       => bcrypt($validated['password']),
            'role'           => $roles->first()->id, // Setting primary role ID just in case your users table still requires it
            'created_at'     => Carbon::now('Asia/Manila'),
        ]);

        // Sync all multiple roles
        $user->syncRoles($roleNames);

        if (in_array('DBRT', $roleNames)) {
            $nameParts = explode(' ', trim($validated['name']));
            $firstname = $nameParts[0];
            $lastname  = count($nameParts) > 1 ? array_pop($nameParts) : null;
            $middlename = count($nameParts) > 1 ? $nameParts[1] : null;

            DatabreachTeam::create([
                'firstname'      => $firstname,
                'middle_initial' => $middlename ? strtoupper(substr($middlename, 0, 1)) : null,
                'lastname'       => $lastname,
                'email'          => $validated['email'],
                'region'         => $validated['region'],
            ]);
        }

        // Send Email Notification with the visible plain password
        Mail::to($user->email)->send(new UserCredentialsMail($user, $validated['password']));

        return redirect()->route('users.index')
            ->with('success', 'User successfully added and account credentials sent via email.');
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin')) {
            return back()->with('error', 'You are not authorized to edit the Super Admin.');
        }

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'region'         => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:15',
            'roles'          => 'required|array', 
            'roles.*'        => 'exists:roles,id',
        ]);

        // Check if updated email or contact number already belongs to another user
        $exists = User::where(function($query) use ($request) {
                $query->where('email', $request->email)
                      ->when($request->contact_number, function($q) use ($request) {
                          $q->orWhere('contact_number', $request->contact_number);
                      });
            })
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Email or contact number already exists.');
        }

        $roles = Role::whereIn('id', $validated['roles'])->get();
        $roleNames = $roles->pluck('name')->toArray();

        // Super Admin checks
        if (in_array('Super Admin', $roleNames)) {
            $anotherSuperAdminExists = User::where('id', '!=', $id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'Super Admin');
                })
                ->exists();

            if ($anotherSuperAdminExists) {
                return back()->withInput()->with('error', 'Super Admin role already exist.');
            }

            if (!auth()->user()->hasRole('Super Admin')) {
                return back()->withInput()->with('error', 'You are not authorized to assign Super Admin role.');
            }
        }

        // DPO checks
        if (in_array('DPO', $roleNames)) {
            $anotherDpoExists = User::where('id', '!=', $id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'DPO');
                })
                ->exists();

            if ($anotherDpoExists) {
                return back()->withInput()->with('error', 'DPO role already exist.');
            }
        }

        $user->update([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'region'         => $validated['region'],
            'contact_number' => $validated['contact_number'],
            'role'           => $roles->first()->id, 
            'updated_at'     => Carbon::now('Asia/Manila'),
        ]);

        $user->syncRoles($roleNames);

        return redirect()->route('users.index')->with('success', 'User successfully updated.');
    }

    // Delete User
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('Super Admin')) {
            return back()->with('error', 'Super Admin cannot be deleted.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}