<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $pageTitle = 'Data User - SD Kristen Pelita Hati';

        return view("admin.masterdata.user.index", compact('user','pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Tambah Data User - SD Kristen Pelita Hati';

        return view("admin.masterdata.user.create",compact('pageTitle'));
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
            ->with('toast_success', 'Data User Berhasil Ditambah');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'Edit Data Tagihan - SD Kristen Pelita Hati';

        return view("admin.masterdata.user.edit", compact('user','pageTitle'));
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
            ->with('toast_success', 'Data User Berhasil di Update!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index')
            ->with('toast_success', 'Data User Berhasil Dihapus.');
    }

}
