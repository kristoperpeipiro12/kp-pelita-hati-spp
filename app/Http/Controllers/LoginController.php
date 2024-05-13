<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    // public function login_proses(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ], [
    //         'username.required' => 'Username Wajib Diisi',
    //         'password.required' => 'Password Wajib Diisi',
    //     ]);

    //     $username = $request->username;
    //     $password = $request->password;

    //     // Fetch user by username
    //     $user = User::where('username', $username)->first();

    //     $siswa = Siswa::where('username',$username)->get();
    //     $siswa = Siswa::where('password',$password)->get();


    //     if ($user && $user->password === $password) {
    //         Auth::login($user);

    //         if ($user->role === 'admin') {
    //             return redirect()->route('admin.dashboard');
    //         } elseif ($siswa->role === 'siswa') {
    //             return redirect()->route('dashboard.siswa');
    //         } elseif ($user->role === 'yayasan') {
    //             return redirect()->route('yayasan.dashboard');
    //         } else {
    //             // If the role is not recognized
    //             Auth::logout();
    //             return redirect()->route('login')->withErrors('Role tidak valid. Silakan hubungi administrator.')->withInput();
    //         }
    //     } else {
    //         return redirect()->route('login')->withErrors('Username atau Password Salah!')->withInput();
    //     }
    // }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $username = $request->username;
        $password = $request->password;

        // Fetch user by username
        $user = User::where('username', $username)->first();

        // Fetch student by username and password
        $siswa = Siswa::where('username', $username)
                      ->where('password', $password)
                      ->first();

        if ($user && $user->password === $password) {
            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($siswa) {
                return redirect()->route('dashboard.siswa');
            } elseif ($user->role === 'yayasan') {
                return redirect()->route('yayasan.dashboard');
            } else {
                // If the role is not recognized
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
