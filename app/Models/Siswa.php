<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table      = 'siswas';
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
        'password',
        'status',
        'tagihan_aktif',
        'tanggal_masuk',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($siswa) {
            $password        = substr((string) $siswa->nis, -6);
            $siswa->password = Hash::make($password);
        });
    }

    public function getNamaAttribute()
    {
        return $this->attributes['nama'];
    }

    public function getKelas()
    {
        return $this->attributes['kelas'];
    }

      public function getTanggalMasuk()
    {
        return $this->attributes['tanggal_masuk'];
    }

    public static function getTotalSiswa()
    {
        return self::where('status', 'aktif')->count();
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'kelas', 'kelas');
    }
}