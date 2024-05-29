<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KonfirmasiPembayaran;
use App\Models\Pemasukan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KonfirmasipembayaranController extends Controller
{
    public function create()
    {
        $siswa = Auth::user();
        $kelas = $siswa->kelas;

        $tagihan      = Tagihan::where('kelas', $kelas)->first();
        $totalTagihan = $tagihan ? $tagihan->total_tagihan : 0;

        return view('siswa.dashboard.transfer', compact('tagihan', 'totalTagihan'));
    }

    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'nis'             => ['required', Rule::exists('siswas', 'nis')],
            'pemasukan'       => 'required|numeric',
            'tanggal'         => 'required|date',
            'jenis_transaksi' => ['required', Rule::in(['transfer'])],
            'foto'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.required' => 'Wajib Sertakan Foto.',
            'foto.image'    => 'Pastikan Foto berupa gambar',
            'foto.mimes'    => 'Foto harus berformat jpg, png, jpeg, atau jfif.',
            'foto.max'      => 'Ukuran foto maksimal 2MB.',
        ]);

        $tanggal          = $request->tanggal;
        $tanggalFormatted = date('d-m-Y', strtotime($tanggal));

        if ($request->hasFile('foto')) {
            $foto                 = $request->file('foto');
            $filename             = $tanggalFormatted . '_' . $validatedata['nis'] . '.' . $foto->getClientOriginalExtension();
            $path                 = $foto->storeAs('Bukti-transfer', $filename, 'public');
            $validatedata['foto'] = $filename;
        }

        $konfirmasi = KonfirmasiPembayaran::create($validatedata);
        $konfirmasi->save();

        return redirect()->route('dashboard.siswa')->with('toast_success', 'Pembayaran Sedang diproses.');
    }

    public function show()
    {
        $konfirmasi = KonfirmasiPembayaran::with('siswa')->where('konfirmasi', 0)->get();
        return view('admin.konfirmasipembayaran.index', compact('konfirmasi'));
    }

    public function confirm($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);

        // Periksa apakah pembayaran sudah dikonfirmasi sebelumnya
        if (0 != $konfirmasiPembayaran->konfirmasi) {
            return redirect()->back()->with('toast_error', 'Pembayaran sudah dikonfirmasi sebelumnya.');
        }

        $jenisTransaksi = 'transfer';

        // Simpan data pemasukan
        Pemasukan::create([
            'nis'            => $konfirmasiPembayaran->nis,
            'pemasukan'      => $konfirmasiPembayaran->pemasukan,
            'tanggal'        => $konfirmasiPembayaran->tanggal,
            'jenistransaksi' => $jenisTransaksi,
        ]);

        // Perbarui status konfirmasi menjadi 1
        $konfirmasiPembayaran->update(['konfirmasi' => 1]);

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pembayaran telah dikonfirmasi.');
    }

    public function reject($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $konfirmasiPembayaran->delete();

        return redirect()->route('admin.konfirmasi')->with('toast_success', 'Pembayaran ditolak.');
    }
}