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

    // public function login_proses(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'username' => ['required'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::guard('siswa')->attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->route('dashboard.siswa');
    //     } elseif (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         $user = Auth::user();
    //         if ($user->role == 'admin') {
    //             return redirect()->route('admin.dashboard');
    //         } elseif ($user->role == 'yayasan') {
    //             return redirect()->route('yayasan.dashboard');
    //         }
    //     }

    //     return back()->withErrors([
    //         'username' => 'Kombinasi username dan password tidak valid.',
    //     ]);
    // }

    public function login_proses(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('siswa')->attempt(['nis' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('siswa');
        } else {
            if (Auth::guard('web')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                $user = Auth::user();
                if ('admin' == $user->role) {
                    return redirect()->route('admin');
                } elseif ('yayasan' == $user->role) {
                    return redirect()->route('yayasan');
                }
            }
        }

        return redirect()->route('login')->withErrors(['login' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        // Logout dari semua guard
        foreach (['siswa', 'web'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
            }
        }

        // Hapus sesi dan regenerasi ID sesi untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil keluar.');
    }
}