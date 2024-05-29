<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $siswa = Auth::user();
        $kelas = $siswa->kelas;


        $tagihan = Tagihan::where('kelas', $kelas)->first();
        $totalTagihan = $tagihan ? $tagihan->total_tagihan : 0;

        $informasi = Informasi::where('tampil', 1)->get();

        return view('siswa.dashboard.index', compact('totalTagihan','informasi'));
    }
}
