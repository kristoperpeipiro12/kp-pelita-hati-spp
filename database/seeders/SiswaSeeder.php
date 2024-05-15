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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('siswa')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); // Truncate the table before inserting new data

        $faker = Faker::create('id_ID'); // Set locale to Indonesian

        for ($i = 1; $i <= 50; $i++) {
            $class       = ($i % 6) + 1; // Calculate the class from 1 to 6
            $classLetter = $i % 2 == 0 ? 'B' : 'A'; // Alternate between A and B for each class

            for ($j = 0; $j < 2; $j++) {
                $jenis_kelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);
                $nis           = mt_rand(10000000, 99999999); // Generate a random 8-digit number

                // Generate name based on gender
                $nama = 'Laki-laki' == $jenis_kelamin ? $faker->firstNameMale . ' ' . $faker->lastName : $faker->firstNameFemale . ' ' . $faker->lastName;

                DB::table('siswa')->insert([
                    'nis'           => $nis,
                    'nama'          => $nama,
                    'alamat'        => 'Pontianak, Kalimantan Barat',
                    'tanggal_lahir' => $faker->date('Y-m-d', '2005-12-31'), // Random date for age consideration
                    'jenis_kelamin' => $jenis_kelamin,
                    'nohp'          => '08' . mt_rand(10000000, 99999999), // Random Indonesian phone number
                    'kelas'         => $class . $classLetter, // Assign class 1A, 1B, 2A, 2B, etc.
                    'password' => Hash::make(substr($nis, -6)), // Hash the first 6 characters of NIS for the password
                ]);
            }
        }
    }
}