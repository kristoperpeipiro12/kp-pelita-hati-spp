<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KonfirmasiPembayaran;
use App\Models\Pemasukan;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class KonfirmasipembayaranController extends Controller
{
    // public function index()
    // {
    //     $viaTF = KonfirmasiPembayaran::where('jenistransaksi', 'transfer')->get();
    //     $murid = Siswa::whereIn('nis', $viaTF->pluck('nis'))->get()->groupBy('nis');

    //     return view('admin.konfirmasipembayaran.index', compact('viaTF', 'murid'));
    //     // $konfirmasiPembayaran = KonfirmasiPembayaran::with('siswa')->get();
    //     // return view('admin.konfirmasi_pembayaran.index', compact('konfirmasiPembayaran'));
    // }

    public function create()
    {
        $siswa = Auth::user();
        $kelas = $siswa->kelas;

        $tagihan = Tagihan::where('kelas', $kelas)->first();

        $totalTagihan = $tagihan ? $tagihan->total_tagihan : 0;

        return view('siswa.dashboard.transfer', compact('tagihan', 'totalTagihan'));
    }

    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'nis' => ['required', Rule::exists('siswas', 'nis')],
            'pemasukan' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenis_transaksi' => ['required', Rule::in(['transfer'])],
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.required' => 'Wajib Sertakan Foto.',
            'foto.image' => 'Pastikan Foto berupa gambar',
            'foto.mimes' => 'Foto harus berformat jpg, png, jpeg, atau jfif.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $tanggal = $request->tanggal;
        $tanggalFormatted = date('d-m-Y', strtotime($tanggal));



        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = $tanggalFormatted . '_' . $validatedata['nis'] . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('Bukti-transfer', $filename, 'public');
            $validatedata['foto'] = $filename;
        }

        $konfirmasi = KonfirmasiPembayaran::create($validatedata);
        $konfirmasi->save();

        return redirect()->route('dashboard.siswa')->with('toast_success', 'Pembayaran Sedang diproses.');
    }

    public function show()
    {
        $konfirmasi = KonfirmasiPembayaran::where('konfirmasi', 0)->get();

        return view('admin.konfirmasipembayaran.index', compact('konfirmasi'));
    }

    public function confirm($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);

        if ($konfirmasiPembayaran->konfirmasi != 0) {
            return redirect()->back()->with('toast_error', 'Pembayaran sudah dikonfirmasi sebelumnya.');
        }
        $jenisTransaksi = 'transfer';
        Pemasukan::create([
            'nis' => $konfirmasiPembayaran->nis,
            'pemasukan' => $konfirmasiPembayaran->pemasukan,
            'tanggal' => $konfirmasiPembayaran->tanggal,
            'jenistransaksi' => $jenisTransaksi,
        ]);

        $konfirmasiPembayaran->delete();

        return redirect()->route('pemasukan.index')->with('toast_success', 'Pembayaran telah dikonfirmasi.');
    }


    public function reject($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $konfirmasiPembayaran->delete();


        return redirect()->route('admin.konfirmasi')->with('toast_success', 'Pembayaran ditolak.');
    }
}
