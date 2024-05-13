<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    // Menampilkan semua pengeluaran
    public function index()
    {
        $pengeluaran = Pengeluaran::all();
        $totalPengeluaran = Pengeluaran::getTotalPengeluaran();

        return view('pengeluaran.index', compact('pengeluaran','totalPengeluaran'));
    }

    // Menampilkan form untuk membuat pengeluaran baru
    public function create()
    {
        return view('pengeluaran.create');
    }

    // Menyimpan pengeluaran baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'pengeluaran' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);
        $pengeluaran = str_replace('.', '', $request->pengeluaran);


        Pengeluaran::create([
            'pengeluaran' => $pengeluaran, // Gunakan nilai tanpa titik
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    
    public function edit($id_pengeluaran)
    {
        $pengeluaran = Pengeluaran::findOrFail($id_pengeluaran);
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    // Menyimpan pengeluaran yang sudah diedit ke database
    public function update(Request $request, $id_pengeluaran)
    {
        $request->validate([
            'pengeluaran' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);
        $pengeluarans = str_replace('.', '', $request->pemasukan);
    
        $pengeluaran = Pengeluaran::findOrFail($id_pengeluaran);
        $pengeluaran->update([
            'pengeluaran' => $pengeluarans, // Gunakan nilai tanpa titik
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    // Menghapus pengeluaran berdasarkan id_pengeluaran
    public function delete($id_pengeluaran)
    {
        $pengeluaran = Pengeluaran::findOrFail($id_pengeluaran);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
