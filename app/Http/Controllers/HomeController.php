<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("dashboard.dashboard");
    }

    public function siswa(){
        return view("siswa.dashboard");
    }
    public function yayasan(){
        return view("yayasan.dashboard");
    }
}
