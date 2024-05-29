<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan pemeriksaan kunci asing
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Hapus semua data dalam tabel siswa
        DB::table('siswas')->truncate();

        // Aktifkan kembali pemeriksaan kunci asing
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Buat instance Faker
        $faker = Faker::create('id_ID');

        $tanggal_masuk_kelas = [
            '2023-07-02', // Kelas 1
            '2022-07-02', // Kelas 2
            '2021-07-02', // Kelas 3
            '2020-07-02', // Kelas 4
            '2019-07-02', // Kelas 5
            '2018-07-02', // Kelas 6
        ];

        for ($i = 1; $i <= 100; $i++) {
            $class         = ($i % 6) + 1;
            $tanggal_masuk = $tanggal_masuk_kelas[$class - 1];

            // Generate data siswa sesuai kelas
            $jenis_kelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $nis           = mt_rand(10000000, 99999999);
            $nama          = 'Laki-laki' == $jenis_kelamin ? $faker->firstNameMale . ' ' . $faker->lastName : $faker->firstNameFemale . ' ' . $faker->lastName;

            DB::table('siswas')->insert([
                'nis'           => $nis,
                'nama'          => $nama,
                'alamat'        => 'Pontianak, Kalimantan Barat',
                'tanggal_lahir' => $faker->date('Y-m-d', '2005-12-31'),
                'jenis_kelamin' => $jenis_kelamin,
                'nohp'          => '08' . mt_rand(10000000, 99999999),
                'kelas'         => $class,
                'password'      => Hash::make(substr($nis, -6)),
                'status'        => 'aktif',
                'tagihan_aktif' => '12',
                'tanggal_masuk' => $tanggal_masuk,
            ]);
        }

    }
}