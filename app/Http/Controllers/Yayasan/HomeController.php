<?php

namespace App\Http\Controllers\Yayasan;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class HomeController extends Controller
{
    public function index()
    {
        return view("yayasan.dashboard.index");
    }

    public function pemasukan()
    {
        $pemasukan = Pemasukan::all();
        return view("yayasan.pemasukan.index", compact("pemasukan"));
    }
    public function pengeluaran()
    {
        $pengeluaran = Pengeluaran::all();
        return view("yayasan.pengeluaran.index", compact("pengeluaran"));
    }
}
