<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{

    public function index()
    {
        $informasi = Informasi::all();

        return view('admin.informasi.index', compact('informasi'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'judul'=>'required',
            'info' => 'required',
            'tanggal' => 'required|date',
        ]);

        Informasi::create($validatedData);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);

        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'judul'=>'required',
            'info' => 'required',
            'tanggal' => 'required|date',
        ]);

        $informasi = Informasi::findOrFail($id);
        $informasi->update($validatedData);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $informasi = Informasi::findOrFail($id);

        $informasi->delete();

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }

}
