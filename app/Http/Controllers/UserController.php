<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view("masterdata.user.index", compact("users"));
    }

    public function create(){
        return view("masterdata.user.create");
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "username" => "required",
            "password" => "required",
            "role" => "required|in:admin,yaysan,siswa",
        ]);

        // Hashing password sebelum menyimpan ke database
        $validatedData['password'] = Hash::make($request->password);

        
        User::create($validatedData);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view("masterdata.user.edit", compact("user"));
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            "username" => "required",
            "role" => "required|in:admin,yaysan,siswa",
        ]);
    
        $user = User::findOrFail($id);    
        
        $user->update($validatedData);
    
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }
    
    public function destroy($id){
        $user = User::findOrFail($id); 
    
        // Menghapus user
        $user->delete();
    
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
    
}
