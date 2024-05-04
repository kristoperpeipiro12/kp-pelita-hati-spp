<?php

namespace Database\Seeders;

use App\Models\Informasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata = [
            [
                'judul' => 'admin',
                'info' => 'khsjgbkjbskhvsh',
                'tanggal' => '09/09/2024',
            ],
        ];

        foreach ($userdata as $data) {
            Informasi::create($data);
        }
    }
}
