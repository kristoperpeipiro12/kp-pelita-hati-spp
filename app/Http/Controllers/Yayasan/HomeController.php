<?php

namespace App\Http\Controllers\Yayasan;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Dashboard - SD Kristen Pelita Hati';

        return view("yayasan.dashboard.index", compact("pageTitle"));
    }

    public function pemasukan()
    {
        // Mengambil data pemasukan dengan konfirmasi 'terima'
        $pemasukan = Pemasukan::where('konfirmasi', 'Terima')->get();
        $pageTitle = 'Data Pemasukan - SD Kristen Pelita Hati';

        return view("yayasan.pemasukan.index", compact("pemasukan", "pageTitle"));
    }
    public function pengeluaran()
    {
        $pengeluaran = Pengeluaran::all();
        $pageTitle   = 'Data Pengeluaran - SD Kristen Pelita Hati';

        return view("yayasan.pengeluaran.index", compact("pengeluaran", "pageTitle"));
    }
}