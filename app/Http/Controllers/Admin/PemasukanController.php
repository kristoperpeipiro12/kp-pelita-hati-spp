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
        $siswa          = Siswa::all();
        $pemasukan      = Pemasukan::all();
        $totalPemasukan = Pemasukan::getTotalPemasukan();
        $pageTitle      = 'Data Pemasukan - SD Kristen Pelita Hati';
        return view('admin.pemasukan.index', compact(
            'pemasukan',
            'siswa',
            'totalPemasukan',
            'pageTitle'
        ));
    }

    public function create()
    {
        $pageTitle = 'Tambah Data Pemasukan - SD Kristen Pelita Hati';

        return view('admin.pemasukan.create', compact(
            'pageTitle'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'             => ['required', Rule::exists('siswas', 'nis')],
            'tanggal_bayar'   => 'required|date',
            'bulan_tagihan'   => 'required',
            'tahun_tagihan'   => 'required',
            'jenis_transaksi' => 'required|in:Kontan,Transfer',
        ]);

        $siswa          = Siswa::where('nis', $request->nis)->firstOrFail();
        $kelas          = $siswa->kelas;
        $tagihan        = Tagihan::where('kelas', $kelas)->first();
        $tagihanPeriode = Pemasukan::where('bulan_tagihan', $request->bulan_tagihan)
            ->where('tahun_tagihan', $request->tahun_tagihan)
            ->where('nis', $request->nis)
            ->first();

        if ($tagihan) {
            if ($tagihanPeriode) {
                return Redirect::back()->withErrors(['error' => 'Tagihan bulan ' . $request->bulan_tagihan . '/' . $request->tahun_tagihan . ' untuk siswa ini sudah diinput.'])->withInput();
            } else {
                $jumlah_bayar = $tagihan->tagihan_perbulan;
                $request->merge(['jumlah_bayar' => $jumlah_bayar]);
                $request->merge(['konfirmasi' => 'Terima']);
                Pemasukan::create($request->all());

                return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil ditambahkan.');
            }
        } else {
            return Redirect::back()->withErrors(['error' => 'Tagihan perbulan tidak ditemukan untuk siswa ini.'])->withInput();
        }
    }

    public function edit($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pageTitle = 'Edit Data Pemasukan - SD Kristen Pelita Hati';
        return view('admin.pemasukan.edit', compact(
            'pemasukan',
            'pageTitle',
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_bayar'   => 'required|date',
            'jenis_transaksi' => 'required|in:Kontan,Transfer',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->all());

        return redirect()->route('pemasukan.index')->with('toast_success', 'Data berhasil diupdate.');
    }

    public function delete($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pemasukan berhasil dihapus.');
    }

    public function konfirmasi(Request $request, $id)
    {
        $pemasukan = Pemasukan::findOrFail($id);

        $request->validate([
            'konfirmasi' => 'required',
        ], [
            'konfirmasi.required' => 'Terjadi kesalahan teknis !',
        ]);

        $pemasukan->konfirmasi = $request->konfirmasi;
        $pemasukan->save();

        return redirect()->route('pemasukan.index')->with('toast_success', 'Data pemasukan berhasil diupdate.');
    }
}
