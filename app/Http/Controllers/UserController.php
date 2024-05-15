<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view("admin.masterdata.user.index", compact("user"));
    }

    public function create()
    {
        return view("admin.masterdata.user.create");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "username" => "required",
            "password" => "required",
            "role"     => "required|in:admin,yayasan,siswa",
        ]);

        // Hashing the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("admin.masterdata.user.edit", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "username" => "required",
            "role"     => "required|in:admin,yayasan,siswa",
        ]);

        $user = User::findOrFail($id);

        // If password field exists in the request and not empty, hash the new password
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully.');
    }

}
