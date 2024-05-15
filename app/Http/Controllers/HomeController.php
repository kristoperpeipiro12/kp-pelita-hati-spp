<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function admin()
    {
        return view("admin.dashboard.index");
    }

    public function yayasan()
    {
        return view("yayasan.dashboard.index");
    }
}