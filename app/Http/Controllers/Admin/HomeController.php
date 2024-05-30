<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class HomeController extends Controller
{
    public function admin()
    {
        $pageTitle = 'Dashboard - SD Kristen Pelita Hati';

        return view("admin.dashboard.index", compact(
            'pageTitle'
        ));
    }

    // Controller method to fetch pemasukan data
    public function getTotalPemasukanPengeluaran()
    {
        $totalPemasukan   = Pemasukan::where('konfirmasi', 'Terima')->sum('jumlah_bayar');
        $totalPengeluaran = Pengeluaran::sum('pengeluaran');

        return response()->json([
            'totalPemasukan'   => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
        ]);
    }

}
