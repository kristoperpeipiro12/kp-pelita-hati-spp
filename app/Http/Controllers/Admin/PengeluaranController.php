<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{

    public function index()
    {
        $pengeluaran      = Pengeluaran::all();
        $totalPengeluaran = Pengeluaran::getTotalPengeluaran();
        $pageTitle = 'Data Pengeluaran - SD Kristen Pelita Hati';

        return view('admin.pengeluaran.index', compact('pengeluaran', 'totalPengeluaran','pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Tambah Data Pengeluaran - SD Kristen Pelita Hati';
        return view('admin.pengeluaran.create',compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengeluaran' => 'required',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
        ]);
        $pengeluaran = str_replace('.', '', $request->pengeluaran);

        Pengeluaran::create([
            'pengeluaran' => $pengeluaran,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('toast_success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit($id_pengeluaran)
    {
        $pengeluaran = Pengeluaran::findOrFail($id_pengeluaran);
        $pageTitle = 'Edit Data Pengeluaran - SD Kristen Pelita Hati';

        return view('admin.pengeluaran.edit', compact('pengeluaran','pageTitle'));
    }

    public function update(Request $request, $id_pengeluaran)
    {
        $request->validate([
            'pengeluaran' => 'required',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
        ]);
        $pengeluarans = str_replace('.', '', $request->pengeluaran);

        $pengeluaran = Pengeluaran::findOrFail($id_pengeluaran);
        $pengeluaran->update([
            'pengeluaran' => $pengeluarans,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
        ]);
        return redirect()->route('pengeluaran.index')
            ->with('toast_success', 'Pengeluaran berhasil diperbarui.');
    }

    public function delete($id_pengeluaran)
    {
        $pengeluaran = Pengeluaran::findOrFail($id_pengeluaran);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
            ->with('toast_success', 'Pengeluaran berhasil dihapus.');
    }
}
