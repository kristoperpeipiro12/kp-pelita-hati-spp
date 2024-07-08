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
            'bulan_tagihan'   => 'required|integer|between:1,12',
            'tahun_tagihan'   => 'required|integer',
            'jenis_transaksi' => 'required|in:Kontan,Transfer',
        ]);

        $siswa          = Siswa::where('nis', $request->nis)->firstOrFail();
        $tagihan        = Tagihan::where('kelas', $siswa->kelas)->first();
        $tagihanPeriode = Pemasukan::where('bulan_tagihan', $request->bulan_tagihan)
            ->where('tahun_tagihan', $request->tahun_tagihan)
            ->where('nis', $request->nis)
            ->first();

        $bulanMasuk   = date('n', strtotime($siswa->tanggal_masuk));
        $tahunMasuk   = date('Y', strtotime($siswa->tanggal_masuk));
        $bulanTagihan = $request->bulan_tagihan;
        $tahunTagihan = $request->tahun_tagihan;
        $currentYear  = date('Y');
        $currentMonth = date('n');

        // Pengecekan kondisi
        if (($tahunTagihan < $tahunMasuk) || ($tahunTagihan == $tahunMasuk && $bulanTagihan < $bulanMasuk)) {
            return Redirect::back()->withErrors(['error' => 'Bulan dan tahun tagihan tidak valid !'])->withInput();
        }

        if (($tahunTagihan > $currentYear) || ($tahunTagihan == $currentYear && $bulanTagihan > $currentMonth)) {
            return Redirect::back()->withErrors(['error' => 'Bulan dan tahun tagihan tidak valid !'])->withInput();
        }

        if ($tagihan) {
            if ($tagihanPeriode) {
                return Redirect::back()->withErrors(['error' => 'Tagihan bulan ' . $request->bulan_tagihan . '/' . $request->tahun_tagihan . ' untuk siswa ini sudah dibayar.'])->withInput();
            } else {
                $jumlah_bayar = $tagihan->tagihan_perbulan;
                $request->merge(['jumlah_bayar' => $jumlah_bayar]);
                $request->merge(['konfirmasi' => 'Terima']);
                Pemasukan::create($request->all());

                $status_konfirmasi = "telah kami terima";

                $pesan_notif_wa = "Halo, " . $siswa->nama . " NIS." . $siswa->nis;
                $pesan_notif_wa .= " Pembayaran Tagihan SPP anda " . $status_konfirmasi;

                try {
                    $this->whatsapp($siswa->nohp, $pesan_notif_wa);
                } catch (\Exception $e) {
                    return redirect()->route('pemasukan.index')->with('toast_error', 'Data pemasukan berhasil diupdate, namun pesan WhatsApp gagal dikirim: ' . $e->getMessage());
                }

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
        $request->validate([
            'konfirmasi' => 'required',
        ], [
            'konfirmasi.required' => 'Terjadi kesalahan teknis!',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $siswa     = Siswa::findOrFail($pemasukan->nis);

        $status_konfirmasi = "";
        switch ($request->konfirmasi) {
            case "Terima":
                $status_konfirmasi = "telah kami terima";
                break;
            case "Tolak":
                $status_konfirmasi = "ditolak, silahkan hubungi administrasi sekolah";
                break;
            case "Pending":
                $status_konfirmasi = "telah disubmit, mohon menunggu konfirmasi lanjutan dari admin";
                break;
            default:
                return redirect()->back()->with('error', 'Status konfirmasi tidak valid.');
        }

        $pesan_notif_wa = "Halo, " . $siswa->nama . " NIS." . $siswa->nis;
        $pesan_notif_wa .= " Pembayaran Tagihan SPP anda " . $status_konfirmasi;

        $pemasukan->konfirmasi = $request->konfirmasi;
        $pemasukan->save();

        try {
            $this->whatsapp($siswa->nohp, $pesan_notif_wa);
        } catch (\Exception $e) {
            return redirect()->route('pemasukan.index')->with('toast_error', 'Data pemasukan berhasil diupdate, namun pesan WhatsApp gagal dikirim: ' . $e->getMessage());
        }

        return redirect()->route('pemasukan.index')->with('toast_success', 'Data pemasukan berhasil diupdate. ');
    }

}