<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        
        $siswa = Siswa::all();
        $totalSiswa = Siswa::getTotalSiswa();
        return view('masterdata.siswa.index', compact('siswa', 'totalSiswa'));
    }

    public function create()
    {

        return view('masterdata.siswa.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|unique:siswa',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp' => 'required',
            'kelas' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,jfif|max:2048',
        ]);
    
        
        if ($request->hasFile('foto')) {
            
            $foto = $request->file('foto');
            $filename = date('d-m-y') . '_' . $validatedData['nama'] . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('foto-siswa', $filename, 'public');
            $validatedData['foto'] = $filename;
        }
    
        // Membuat record siswa
        $siswa = Siswa::create($validatedData);
    
        
        $password = substr($siswa->nis, -6);
        $siswa->password = $password;
        $siswa->save();
    
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil disimpan.');
    }
    

    public function edit($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        return view('masterdata.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nis)
    {
        
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp' => 'required',
            'kelas' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,jfif|max:2048',
        ]);
    
        $siswa = Siswa::findOrFail($nis);
    
        
        if ($request->hasFile('foto')) {
            
            if ($siswa->foto) {
                Storage::disk('public')->delete('foto-siswa/' . $siswa->foto);
            }
    
            
            $foto = $request->file('foto');
            $filename = date('d-m-y') . '_' . $validatedData['nama'] . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('foto-siswa', $filename, 'public');
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
