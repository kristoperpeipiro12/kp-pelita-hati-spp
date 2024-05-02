<?php

namespace App\Http\Controllers;

use App\Models\Informasi; // Import model Informasi
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    // Function untuk menampilkan semua informasi
    public function index()
    {
        // Mengambil semua informasi dari database
        $informasi = Informasi::all();

        // Mengirim data informasi ke view 'informasi.index'
        return view('informasi.index', compact('informasi'));
        // return view("informasi.index");
    }

    // Function untuk menampilkan form tambah informasi
    public function create()
    {
        return view('informasi.index');
    }

    // Function untuk menyimpan data informasi yang ditambahkan
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh form tambah informasi
        $validatedData = $request->validate([
            'judul'=>'required',
            'informasi' => 'required',
            'tanggal' => 'required|date',
        ]);

        // Menyimpan data informasi yang divalidasi ke dalam database
        Informasi::create($validatedData);

        // Mengarahkan pengguna kembali ke halaman index dengan pesan sukses
        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function delete($id)
    {
        // Mengambil data informasi berdasarkan ID
        $informasi = Informasi::findOrFail($id);

        // Menghapus data informasi dari database
        $informasi->delete();

        // Mengarahkan pengguna kembali ke halaman index dengan pesan sukses
        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }

}
