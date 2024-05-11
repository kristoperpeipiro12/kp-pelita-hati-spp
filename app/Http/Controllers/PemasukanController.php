<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {   
        $siswa = Siswa::all();
        $pemasukan = Pemasukan::all();
        $totalPemasukan = Pemasukan::getTotalPemasukan();
        return view('pemasukan.index', compact('pemasukan', 'totalPemasukan'));
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
