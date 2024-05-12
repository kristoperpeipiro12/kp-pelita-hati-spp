<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemasukanController extends Controller
{
    public function index()
    {   
        $siswa = Siswa::all();
        // $siswa = "coba";
        $pemasukan = Pemasukan::all();
        $totalPemasukan = Pemasukan::getTotalPemasukan();
        return view('pemasukan.index', compact('pemasukan','siswa', 'totalPemasukan'));
    }

    public function create()
    {
        return view('pemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => ['required', Rule::exists('siswa', 'nis')],
            'pemasukan' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);

        // Sesuaikan dengan field yang ada di model Pemasukan
        Pemasukan::create([
            'nis' => $request->nis,
            'pemasukan' => $request->pemasukan,
            'tanggal' => $request->tanggal,
            'jenistransaksi' => $request->jenistransaksi,
        ]);

        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil ditambahkan.');
    }

    public function getSiswaNis(Request $request)
    {
        $nis = $request->input('nis');
        // Ubah cara ambil siswaNis agar cocok dengan input yang diberikan
        $siswaNis = Siswa::where('nis', 'LIKE', "%$nis%")->pluck('nis')->toArray();
        return response()->json($siswaNis);
    }

    public function edit($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        return view('pemasukan.edit', compact('pemasukan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|string',
            'pemasukan' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->all());

        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil dihapus.');
    }
}
