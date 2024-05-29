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


        for ($i = 1; $i <= 50; $i++) {

            $class = ($i % 6) + 1;


            for ($j = 0; $j < 2; $j++) {

                $jenis_kelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);


                $nis = mt_rand(10000000, 99999999);


                $nama = $jenis_kelamin == 'Laki-laki' ? $faker->firstNameMale . ' ' . $faker->lastName : $faker->firstNameFemale . ' ' . $faker->lastName;


                DB::table('siswas')->insert([
                    'nis'           => $nis,
                    'nama'          => $nama,
                    'alamat'        => 'Pontianak, Kalimantan Barat',
                    'tanggal_lahir' => $faker->date('Y-m-d', '2005-12-31'),
                    'jenis_kelamin' => $jenis_kelamin,
                    'nohp'          => '08' . mt_rand(10000000, 99999999),
                    'kelas'         => $class,
                    'password'      => Hash::make(substr($nis, -6)),
                    'status'        => 'aktif', // Set kolom status menjadi aktif
                    'tagihan_aktif' => '12'
                ]);
            }
        }
    }
}
