<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);
    
        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($data)) {
            // Mengarahkan sesuai dengan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'siswa') {
                return redirect()->route('dashboard.siswa');
            } elseif (Auth::user()->role === 'yayasan') {
                return redirect()->route('yayasan.dashboard');
            } else {
                // Jika rolenya tidak dikenali, logout dan kirim pesan error
                Auth::logout();
                return redirect()->route('login')->withErrors('Role tidak valid. Silakan hubungi administrator.')->withInput();
            }
        } else {
            return redirect()->route('login')->withErrors('Username atau Password Salah!')->withInput();
        }
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil keluar.');
    }
}
