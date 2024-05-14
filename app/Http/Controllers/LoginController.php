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
 
        if (Auth::guard('siswa')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('dashboard.siswa');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            if ($user->role == 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
        }

        if (Auth::guard('yayasan')->attempt($credentials)) {
            $user = Auth::guard('yayasan')->user();
            if ($user->role == 'yayasan') {
                $request->session()->regenerate();
                return redirect()->route('yayasan.dashboard');
            }
        }
        // if (Auth::guard('web')->attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->route('admin.dashboard');
        // }
        // if (Auth::guard('yayasan')->attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->route('yayasan.dashboard');
        // }

    }
  
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil keluar.');
    }
}
