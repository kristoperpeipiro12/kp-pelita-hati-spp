<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $userdata = [
            [
                'username' => 'admin',
                'password' => 'admin',
                'role' => 'admin',
            ],
            [
                'username' => 'yayasan',
                'password' => 'yayasan',
                'role' => 'yayasan',
            ],
            [
                'username' => 'siswa',
                'password' => 'siswa',
                'role' => 'siswa',
            ],
        ];

        foreach ($userdata as $data) {
            User::create($data);
        }
    }
}
