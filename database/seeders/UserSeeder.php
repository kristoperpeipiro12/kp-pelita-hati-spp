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
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'username' => 'yayasan',
                'password' => bcrypt('yayasan'),
                'role' => 'yayasan',
            ],
            [
                'username' => 'siswa',
                'password' => bcrypt('siswa'),
                'role' => 'siswa',
            ],
        ];

        foreach ($userdata as $data) {
            User::create($data);
        }
    }
}
