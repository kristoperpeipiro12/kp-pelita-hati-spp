<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {   
        $siswa= Siswa::all();
        $pemasukan = Pemasukan::all();
        return view('pemasukan.index', compact('pemasukan'));
    }

    public function create()
    {
        return view('pemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:siswa,nis',
            'pemasukan' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);

        Pemasukan::create($request->all());

        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil ditambahkan.');
    }

    public function show(Pemasukan $pemasukan)
    {
        return view('pemasukan.show', compact('pemasukan'));
    }

    public function edit(Pemasukan $pemasukan)
    {
        // Logika untuk menampilkan form pengeditan pemasukan
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        $request->validate([
            'nis' => 'required|string',
            'pemasukan' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);

        $pemasukan->update($request->all());

        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil diperbarui.');
    }

    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil dihapus.');
    }
}
