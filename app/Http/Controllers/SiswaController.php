<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data siswa dari database
        $siswa = Siswa::all();
        // Menampilkan data siswa ke view
        return view('masterdata.siswa.index', compact('siswa'));
    }

    public function create()
    {
        // Menampilkan form tambah siswa
        return view('masterdata.siswa.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh form tambah siswa
        $validatedData = $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp' => 'required',
            'kelas' => 'required',
            'foto'=> 'required|mimes:jpg,png,jpeg,jfif|max:2048',
        ]);
        
        // Menyimpan foto siswa
        $foto = $request->file('foto');
        $filename = date('d-m-y') . '.' . $foto->getClientOriginalExtension();
        $path = $foto->storeAs('foto-siswa', $filename, 'public');

        // Membuat record siswa baru dengan data yang divalidasi
        Siswa::create(array_merge($validatedData, ['foto' => $path]));

        // Mengarahkan pengguna kembali ke halaman index dengan pesan sukses
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil disimpan.');
    }

    public function edit($nis)
    {
        // Mengambil data siswa yang akan diedit dari database
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        // Menampilkan form edit siswa beserta data siswa yang akan diedit
        return view('masterdata.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nis)
    {
        // Validasi data yang dikirimkan oleh form edit siswa
        $validatedData = $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp' => 'required',
            'kelas' => 'required',
            'foto'=> 'nullable|mimes:jpg,png,jpeg,jfif|max:2048',
        ]);

        // Mengambil data siswa yang akan diupdate dari database
        $siswa = Siswa::findOrFail($nis);

        // Menghapus foto lama jika ada foto baru yang diunggah
        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($siswa->foto);
            $foto = $request->file('foto');
            $filename = date('d-m-y') . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('foto-siswa', $filename, 'public');
            $validatedData['foto'] = $path;
        }

        // Mengupdate record siswa dengan data yang divalidasi
        $siswa->update($validatedData);

        // Mengarahkan pengguna kembali ke halaman index dengan pesan sukses
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($nis)
    {
        // Menghapus data siswa dari database
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        
        // Menghapus foto siswa jika ada
        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }

        // Menghapus record siswa dari database
        $siswa->delete();
        
        // Mengarahkan pengguna kembali ke halaman index
        return redirect()->route('siswa.index');
    }
}

