<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Pemasukan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemasukanController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();

        $pemasukan = Pemasukan::all();
        $totalPemasukan = Pemasukan::getTotalPemasukan();
        return view('admin.pemasukan.index', compact('pemasukan','siswa', 'totalPemasukan'));
    }

    public function create()
    {
        return view('admin.pemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => ['required', Rule::exists('siswa', 'nis')],
            'pemasukan' => 'required',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);


        $pemasukan = str_replace('.', '', $request->pemasukan);

        Pemasukan::create([
            'nis' => $request->nis,
            'pemasukan' => $pemasukan,
            'tanggal' => $request->tanggal,
            'jenistransaksi' => $request->jenistransaksi,
        ]);

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        return view('admin.pemasukan.edit', compact('pemasukan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|string',
            'pemasukan' => 'required',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);


        $pemasukans = str_replace('.', '', $request->pemasukan);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update([
            'nis' => $request->nis,
            'pemasukan' => $pemasukans,
            'tanggal' => $request->tanggal,
            'jenistransaksi' => $request->jenistransaksi,
        ]);

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil diperbarui.');
    }


    public function delete($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil dihapus.');
    }
}
