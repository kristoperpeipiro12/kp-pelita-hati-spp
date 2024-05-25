<?php

namespace App\Http\Controllers\Yayasan;

use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function index()
    {
        return view("yayasan.dashboard.index");
    }

}
