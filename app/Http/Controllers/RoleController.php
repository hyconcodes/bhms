<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Display a listing of the roles.
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Show the form for creating a new role.
    public function create()
    {
        return view('roles.create');
    }

    // Store a newly created role in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug',
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Display the specified role.
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    // Show the form for editing the specified role.
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Update the specified role in storage.
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Remove the specified role from storage.
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
