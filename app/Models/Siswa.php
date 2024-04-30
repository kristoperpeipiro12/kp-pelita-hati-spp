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

    // Jika kolom 'foto' adalah tipe file yang diunggah, Anda mungkin ingin mengonfigurasi
    // aksesornya (accessor) untuk mengembalikan URL lengkap ke file gambar.
    // public function getFotoAttribute($value)
    // {
    //     return asset('storage/' . $value);
    // }
}
