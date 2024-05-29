<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Pemasukan;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class PemasukanController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        $pemasukan = Pemasukan::all();
        $totalPemasukan = Pemasukan::getTotalPemasukan();

        return view('admin.pemasukan.index', compact('pemasukan', 'siswa', 'totalPemasukan'));
    }

    public function create()
    {
        return view('admin.pemasukan.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nis' => ['required', Rule::exists('siswas', 'nis')],
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);


        $siswa = Siswa::where('nis', $request->nis)->firstOrFail();
        $kelas = $siswa->kelas;

        $tagihan = Tagihan::where('kelas', $kelas)->first();

        if ($tagihan) {

            $pemasukan = $tagihan->tagihan_perbulan;
            $request->merge(['pemasukan' => $pemasukan]);


            Pemasukan::create($request->all());


            return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil ditambahkan.');
        } else {

            return Redirect::back()->withErrors(['error' => 'Tagihan perbulan tidak ditemukan untuk siswa ini.'])->withInput();
        }
    }
    public function edit($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        return view('admin.pemasukan.edit', compact('pemasukan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|string',
            'pemasukan' => 'required',
            'tanggal' => 'required|date',
            'jenistransaksi' => 'required|in:kontan,transfer',
        ]);

        $pemasukan = str_replace('.', '', $request->pemasukan);

        $pemasukanModel = Pemasukan::findOrFail($id);
        $pemasukanModel->update([
            'nis' => $request->nis,
            'pemasukan' => $pemasukan,
            'tanggal' => $request->tanggal,
            'jenistransaksi' => $request->jenistransaksi,
        ]);

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil dihapus.');
    }

   
}
