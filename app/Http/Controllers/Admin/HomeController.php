<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function admin()
    {
        $pageTitle = 'Dashboard - SD Kristen Pelita Hati';

        return view("admin.dashboard.index", compact(
            'pageTitle'
        ));
    }

}