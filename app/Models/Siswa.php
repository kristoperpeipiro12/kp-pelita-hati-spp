<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Support\Facades\Hash;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $guarded = [];

    protected $fillable = [
        'nis',
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'nohp',
        'kelas',
        'foto',
        'username', 
    ];

    
    public static function boot()
    {
        parent::boot();

        static::saving(function ($siswa) {
            // Mengatur nilai username dengan nis
            $siswa->username = $siswa->nis;
            
            // Mengambil 6 digit terakhir dari NIS dan mengatur sebagai password
            $password = substr($siswa->nis, -6);
            $siswa->password = Hash::make($password);
        });
    }

    public static function getTotalSiswa()
    {
        return self::count();
    }
}
