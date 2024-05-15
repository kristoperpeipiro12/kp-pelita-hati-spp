<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Siswa extends Authenticatable
{
    protected $table      = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing  = false;
    protected $keyType    = 'integer';
    protected $guarded    = [];

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

    public static function boot()
    {
        parent::boot();

        static::saving(function ($siswa) {
            // Mengatur nilai username dengan nis
            // $siswa->username = $siswa->nis;

            $siswa->password = Hash::make((string) $siswa->nis);
        });
    }

    public static function getTotalSiswa()
    {
        return self::count();
    }
}