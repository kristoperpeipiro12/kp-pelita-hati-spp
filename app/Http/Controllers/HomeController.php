<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("dashboard.dashboard");
    }
    public function fungsi(){
        return view("masterdata.user.index");
    }
}
