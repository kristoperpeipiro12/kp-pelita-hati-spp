<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view("siswa.dashboard.index");
    }
}