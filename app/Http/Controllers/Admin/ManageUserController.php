<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        $data = User::paginate(5);
        return view(
            'pages.dashboard.management-user.index',
            get_defined_vars()
        );
    }

    public function create()
    {
        return view('pages.dashboard.management-user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'fullname' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'name_bank' => 'nullable|string|max:255',
            'no_bank' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        User::create($validatedData);

        return redirect()->route('dashboard.management-user.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view(
            'pages.dashboard.management-user.edit', 
            get_defined_vars()
        );
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $data->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $data->id,
            'fullname' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'name_bank' => 'nullable|string|max:255',
            'no_bank' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        $data->update($validatedData);

        return redirect()->route('dashboard.management-user.index')->with('success', 'User updated successfully.');
    }
}
