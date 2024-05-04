<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{

    public function index()
    {
        $informasi = Informasi::all();

        return view('informasi.index', compact('informasi'));
        // return view("informasi.index");
    }

    public function create()
    {
        return view('informasi.index');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh form tambah informasi
        $validatedData = $request->validate([
            'judul'=>'required',
            'info' => 'required',
            'tanggal' => 'required|date',
        ]);

        Informasi::create($validatedData);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $informasi = Informasi::findOrFail($id);

        $informasi->delete();

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }

}
