<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        $permissions = Permission::orderBy('name')->get(); 
        return view('roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        // Check if role name already exists
        $exists = Role::where('name', $request->name)->exists();
        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Role name already exists');
        }

        $role = Role::create(['name' => $validated['name']]);

        // Convert IDs to Permission objects
        $permissions = Permission::whereIn('id', $validated['permissions'] ?? [])->get();
        $role->syncPermissions($permissions);

        return back()->with('success', 'Role created successfully.');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        // Check if another role already uses this name
        $exists = Role::where('name', $request->name)
                      ->where('id', '!=', $id)
                      ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Role name already exists');
        }

        $role->update(['name' => $validated['name']]);

        $permissions = Permission::whereIn('id', $validated['permissions'] ?? [])->get();
        $role->syncPermissions($permissions);

        return back()->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id); 
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}