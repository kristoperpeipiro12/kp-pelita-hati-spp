<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    protected $fillable = [
        'nis',
        'pemasukan',
        'tanggal',
        'jenistransaksi',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public static function getTotalPemasukan()
    {
        return self::sum('pemasukan');
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
