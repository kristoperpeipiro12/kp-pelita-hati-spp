<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function admin()
    {
        return view("admin.dashboard.index");
    }

}
