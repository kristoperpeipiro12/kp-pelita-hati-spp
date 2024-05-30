<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TagihanController extends Controller
{
    public function show()
    {
        $siswa = Auth::user();
        $kelas = $siswa->kelas;

        $tagihan      = Tagihan::where('kelas', $kelas)->first();
        $totalTagihan = $tagihan ? $tagihan->total_tagihan : 0;

        return view('siswa.dashboard.transfer', compact('tagihan', 'totalTagihan'));
    }

    public function bayar(Request $request)
    {
        $validatedata = $request->validate([
            'nis'             => ['required', Rule::exists('siswas', 'nis')],
            'tanggal_bayar'   => 'required|date',
            'jumlah_bayar'    => 'required|numeric',
            'bulan_tagihan'   => 'required',
            'tahun_tagihan'   => 'required',
            'jenis_transaksi' => ['required', Rule::in(['Transfer'])],
            'foto'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.required' => 'Wajib Sertakan Foto.',
            'foto.image'    => 'Pastikan Foto berupa gambar',
            'foto.mimes'    => 'Foto harus berformat jpg, png, jpeg, atau gif.',
            'foto.max'      => 'Ukuran foto maksimal 2MB.',
        ]);

        $validatedata['konfirmasi'] = 'Pending';

        $tanggal          = $request->tanggal_bayar;
        $tanggalFormatted = date('d-m-Y', strtotime($tanggal));

        if ($request->hasFile('foto')) {
            $foto                 = $request->file('foto');
            $filename             = $tanggalFormatted . '_' . $validatedata['nis'] . '.' . $foto->getClientOriginalExtension();
            $path                 = $foto->storeAs('bukti-transfer-', $filename, 'public');
            $validatedata['foto'] = $filename;
        }

        $pemasukan = Pemasukan::create($validatedata);
        $pemasukan->save();

        return redirect()->route('dashboard.siswa')->with('toast_success', 'Pembayaran Sedang diproses.');
    }

}