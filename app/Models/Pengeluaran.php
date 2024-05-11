<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $primaryKey = 'id_pengeluaran';

    protected $fillable = ['pengeluaran', 'tanggal', 'keterangan'];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public static function getTotalPengeluaran()
    {
        return self::sum('pengeluaran');
    }
}
