<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Pemasukan;
use App\Models\Tagihan;
use DateTime;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $siswa            = Auth::user();
        $kelas            = $siswa->kelas;
        $nis              = $siswa->nis;
        $tanggal_masuk    = new DateTime($siswa->tanggal_masuk); // Ubah ke objek DateTime
        $tanggal_sekarang = new DateTime(); // Ubah ke objek DateTime
        $interval         = $tanggal_masuk->diff($tanggal_sekarang);
        $total_bulan      = $interval->y * 12 + $interval->m;

        $data_tagihan     = Tagihan::where('kelas', $kelas)->first();
        $tagihan_perbulan = $data_tagihan->tagihan_perbulan;

        // Buat array untuk menyimpan informasi pembayaran per bulan
        $data_pembayaran             = [];
        $total_tagihan_dibayar       = 0;
        $total_tagihan_belum_dibayar = 0;
        $bulan_dibayar               = 0;
        $bulan_belum_dibayar         = 0;

        // Iterasi melalui setiap bulan
        for ($i = 0; $i <= $total_bulan; $i++) {
            $bulan = $tanggal_masuk->format('n');
            $tahun = $tanggal_masuk->format('Y');

            // $bulan = 7;
            $selisih_tahun = $tanggal_sekarang->format('Y') - $tanggal_masuk->format('Y');

            if ($tanggal_sekarang->format('n') < $bulan - 1) {
                $selisih_tahun--;
            }

            if ($selisih_tahun > 0) {
                // Jika selisih tahun positif, kelas akan berkurang sesuai selisih tahun
                $kelas = $siswa->kelas - $selisih_tahun;
                // Pastikan kelas tidak kurang dari 1
                $kelas = max(1, $kelas);
            } else {
                // Jika selisih tahun tidak positif, maka tetap gunakan kelas sekarang
                $kelas = $siswa->kelas;
            }

            // Ambil tagihan perbulan sesuai dengan kelas
            $data_tagihan = Tagihan::where('kelas', $kelas)->first();
            if ($data_tagihan) {
                $tagihan_perbulan = $data_tagihan->tagihan_perbulan;
            }

            // Periksa apakah sudah ada pembayaran untuk bulan dan tahun ini
            $pembayaran = Pemasukan::where('nis', $nis)
                ->where('bulan_tagihan', $bulan)
                ->where('tahun_tagihan', $tahun)
                ->first();

            // Hitung jumlah total tagihan
            $jumlah_bayar      = $tagihan_perbulan;
            $status_pembayaran = 'Belum dibayarkan';

            if ($pembayaran) {
                if ('Terima' == $pembayaran->konfirmasi) {
                    $status_pembayaran = 'Lunas';
                    $total_tagihan_dibayar += $pembayaran->jumlah_bayar;
                    $bulan_dibayar++;
                } else {
                    $total_tagihan_belum_dibayar += $tagihan_perbulan;
                    $bulan_belum_dibayar++;

                    if ('Tolak' == $pembayaran->konfirmasi) {
                        $status_pembayaran = "Ditolak, silahkan hubungi admin";
                    } else {
                        $status_pembayaran = $pembayaran->konfirmasi;
                    }
                }
                $jumlah_bayar = $pembayaran->jumlah_bayar;
            } else {
                $total_tagihan_belum_dibayar += $tagihan_perbulan;
                $bulan_belum_dibayar++;
            }

            // Tambahkan informasi pembayaran ke dalam array
            $data_pembayaran[$tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT)] = [
                'jumlah_tagihan'    => $jumlah_bayar,
                'bulan'             => $bulan,
                'tahun'             => $tahun,
                'sudah_dibayar'     => $pembayaran ? true : false,
                'status_pembayaran' => $status_pembayaran,
            ];

            // Tambahkan satu bulan ke tanggal masuk
            $tanggal_masuk->modify('+1 month');
        }

        // Urutkan array pembayaran berdasarkan tahun dan bulan
        krsort($data_pembayaran);

        $data_informasi = Informasi::where('tampil', 'Tayang')->orderBy('id', 'desc')->get();
        $pageTitle      = 'Home - SD Kristen Pelita Hati';

        return view('siswa.dashboard.index', compact('data_pembayaran', 'data_informasi', 'pageTitle', 'total_tagihan_dibayar', 'total_tagihan_belum_dibayar', 'bulan_dibayar', 'bulan_belum_dibayar'));
    }

}
