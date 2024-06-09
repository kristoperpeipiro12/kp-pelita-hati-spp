<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Siswa;
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

    public function whatsapp($no_hp, $pesan)
    {
        $curl  = curl_init();
        $token = "4ln3XfGh6cATzljjNH4ShQynGZASC8KS53p0Nz2aLvPc9QaoGE2ySVlagYCOmXI2";
        $data  = [
            'phone'   => $no_hp,
            'message' => $pesan,
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: $token",
            "Content-Type: application/x-www-form-urlencoded",
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://jogja.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);

        if (false === $result) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new \Exception("Curl error: " . $error);
        }

        curl_close($curl);
        return $result;
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
            'foto'            => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'foto.required' => 'Wajib Sertakan Foto.',
            'foto.image'    => 'Pastikan Foto berupa gambar',
            'foto.mimes'    => 'Foto harus berformat jpg, png, jpeg',
            'foto.max'      => 'Ukuran foto maksimal 2MB.',
        ]);

        $siswa            = Siswa::findOrFail($validatedata['nis']);
        $tanggal          = $request->tanggal_bayar;
        $tanggalFormatted = date('d-m-Y', strtotime($tanggal));
        if ($request->hasFile('foto')) {
            $foto     = $request->file('foto');
            $filename = $tanggalFormatted . '_' . $validatedata['nis'] . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('bukti-transfer', $filename, 'public');
            $validatedata['foto'] = $filename;
        }

        $status_konfirmasi = "telah disubmit, mohon menunggu konfirmasi lanjutan dari administrator";

        $pesan_notif_wa = "Halo, " . $siswa->nama . " NIS." . $siswa->nis;
        $pesan_notif_wa .= " Pembayaran Tagihan SPP anda " . $status_konfirmasi;

        try {
            $this->whatsapp($siswa->nohp, $pesan_notif_wa);
        } catch (\Exception $e) {
            return redirect()->route('siswa.dashboard')->with('toast_error', 'Konfirmasi pembayaran sedang diproses, namun pesan WhatsApp gagal dikirim: ' . $e->getMessage());
        }

        $pemasukan = Pemasukan::create($validatedata);
        $pemasukan->save();

        return redirect()->route('siswa.dashboard')->with('toast_success', 'Konfirmasi pembayaran sedang diproses.');
    }

}