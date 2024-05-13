<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemasukanController extends Controller
{
    public function index()
    {   
        $siswa = Siswa::all();
        
        $pemasukan = Pemasukan::all();
        $totalPemasukan = Pemasukan::getTotalPemasukan();
        return view('pemasukan.index', compact('pemasukan','siswa', 'totalPemasukan'));
    }

    public function create()
    {
        return view('pemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => ['required', Rule::exists('siswa', 'nis')],
            'pemasukan' => 'required',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);
    
        // Hilangkan titik dari nilai pemasukan
        $pemasukan = str_replace('.', '', $request->pemasukan);
    
        Pemasukan::create([
            'nis' => $request->nis,
            'pemasukan' => $pemasukan, // Gunakan nilai tanpa titik
            'tanggal' => $request->tanggal,
            'jenistransaksi' => $request->jenistransaksi,
        ]);
    
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
            'pemasukan' => 'required',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);
    
        // Hilangkan titik dari nilai pemasukan
        $pemasukans = str_replace('.', '', $request->pemasukan);
    
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update([
            'nis' => $request->nis,
            'pemasukan' => $pemasukans, // Gunakan nilai tanpa titik
            'tanggal' => $request->tanggal,
            'jenistransaksi' => $request->jenistransaksi,
        ]);
    
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil diperbarui.');
    }
    

    public function delete($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil dihapus.');
    }
}
