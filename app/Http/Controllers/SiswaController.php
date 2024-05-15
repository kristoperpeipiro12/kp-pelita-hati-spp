<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {

        $siswa      = Siswa::all();
        $totalSiswa = Siswa::getTotalSiswa();
        return view('admin.masterdata.siswa.index', compact('siswa', 'totalSiswa'));
    }

    public function create()
    {

        return view('admin.masterdata.siswa.create');
    }

    public function store(Request $request)
    {
        // Validasi data dengan pesan kesalahan kustom
        $validatedData = $request->validate([
            'nis'           => 'required|unique:siswa,nis',
            'nama'          => 'required',
            'alamat'        => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp'          => 'required',
            'kelas'         => 'required',
            'foto'          => 'nullable|image|mimes:jpg,png,jpeg,jfif|max:2048',
        ], [
            'nis.required'           => 'NIS wajib diisi.',
            'nis.unique'             => 'NIS sudah terdaftar.',
            'nama.required'          => 'Nama wajib diisi.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'nohp.required'          => 'Nomor HP wajib diisi.',
            'kelas.required'         => 'Kelas wajib diisi.',
            'foto.image'             => 'Foto harus berupa gambar.',
            'foto.mimes'             => 'Foto harus berformat jpg, png, jpeg, atau jfif.',
            'foto.max'               => 'Ukuran foto maksimal 2MB.',
        ]);

        // Jika ada file foto yang diupload, simpan dan dapatkan namanya
        if ($request->hasFile('foto')) {
            $foto                  = $request->file('foto');
            $filename              = date('d-m-y') . '_' . $validatedData['nama'] . '.' . $foto->getClientOriginalExtension();
            $path                  = $foto->storeAs('foto-siswa', $filename, 'public');
            $validatedData['foto'] = $filename;
        }

        // Membuat record siswa
        $siswa = Siswa::create($validatedData);

        $password = substr($siswa->nis, -6);

        // Membuat hash dari password sebelum disimpan
        $siswa->password = Hash::make($password);
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil disimpan.');
    }

    public function edit($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        return view('admin.masterdata.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nis)
    {

        $validatedData = $request->validate([
            'nis'           => 'required|unique:siswa,nis',
            'nama'          => 'required',
            'alamat'        => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp'          => 'required',
            'kelas'         => 'required',
            'foto'          => 'nullable|image|mimes:jpg,png,jpeg,jfif|max:2048',
        ], [
            'nis.required'           => 'NIS wajib diisi.',
            'nis.unique'             => 'NIS sudah terdaftar.',
            'nama.required'          => 'Nama wajib diisi.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'nohp.required'          => 'Nomor HP wajib diisi.',
            'kelas.required'         => 'Kelas wajib diisi.',
            'foto.image'             => 'Foto harus berupa gambar.',
            'foto.mimes'             => 'Foto harus berformat jpg, png, jpeg, atau jfif.',
            'foto.max'               => 'Ukuran foto maksimal 2MB.',
        ]);

        $siswa = Siswa::findOrFail($nis);

        if ($request->hasFile('foto')) {

            if ($siswa->foto) {
                Storage::disk('public')->delete('foto-siswa/' . $siswa->foto);
            }

            $foto                  = $request->file('foto');
            $filename              = date('d-m-y') . '_' . $validatedData['nama'] . '.' . $foto->getClientOriginalExtension();
            $path                  = $foto->storeAs('foto-siswa', $filename, 'public');
            $validatedData['foto'] = $filename;
        }

        $siswa->update($validatedData);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();

        if ($siswa->foto) {

            Storage::disk('public')->delete('foto-siswa/' . $siswa->foto);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

}
