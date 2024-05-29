<?php

namespace Database\Seeders;
use App\Models\Tagihan;
use Illuminate\Database\Seeder;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        $dataList = [];

        for ($kelas = 1; $kelas <= 6; $kelas++) {
            $tagihan_perbulan = rand(100000, 200000);
            $total_tagihan    = $tagihan_perbulan * 12;

            $dataList[] = [
                'kelas'            => $kelas,
                'tagihan_perbulan' => $tagihan_perbulan,
                'total_tagihan'    => $total_tagihan,
            ];
        }

        foreach ($dataList as $data) {
            Tagihan::create($data);
        }
    }
}