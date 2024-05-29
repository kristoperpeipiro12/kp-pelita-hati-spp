<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        $siswa = Siswa::select('nis', 'nama', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'nohp', 'kelas')->get();
        // dd($siswa);
        // Log::info($siswa);
        return view('admin.masterdata.siswa.index', compact('siswa'));
    }
}
