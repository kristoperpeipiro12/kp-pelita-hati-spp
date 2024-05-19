<?php

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Controllers\SiswaController;

class SiswaExport implements FromView
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $siswa = Siswa::select('nis', 'nama', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'nohp', 'kelas')->get();
        return view('admin.masterdata.siswa.index', compact('siswa'));
    }
}
