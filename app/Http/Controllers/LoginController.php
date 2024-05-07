<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }
    public function login_proses(Request $request)
    {
        $request->validate([
            'username'    => 'required',
            'password' => 'required',
        ],[
            'username.required'=>'Username Wajib Disi',
            'password.required'=>'password Wajib Disi',

        ]);
        $data = [
            'username'    => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->withErrors('Email atau Password Salah!')->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda Berhasi keluar');
    }
}
