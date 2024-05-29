<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfirmasiPembayaran extends Model
{
    use HasFactory;

    protected $table      = 'konfirmasipembayaran';
    protected $primaryKey = 'id';
    protected $fillable   = ['nis', 'pemasukan', 'tanggal', 'jenis_transaksi', 'foto', 'konfirmasi'];

    /**
     * Relationship dengan model Siswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
