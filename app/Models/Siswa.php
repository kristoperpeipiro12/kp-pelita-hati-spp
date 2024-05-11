<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'nis';

    protected $fillable = [
        'nis',
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'nohp',
        'kelas',
        'foto',
    ];

    public static function getTotalSiswa()
    {
        return self::count();
    }
}
