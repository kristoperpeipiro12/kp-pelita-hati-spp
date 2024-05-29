<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    protected $fillable = [
        'nis',
        'bulan_tagihan',
        'tahun_tagihan',
        'jumlah_bayar',
        'tanggal_bayar',
        'jenis_transaksi',
        'konfirmasi',
        'foto',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public static function getTotalPemasukan()
    {
        return self::sum('jumlah_bayar');
    }

    public function getTag()
    {
        return Tagihan::all();
    }

    public function getKelas($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        return $siswa->kelas;
    }
}