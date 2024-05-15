<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $userdata = [
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role'     => 'admin',
            ],
            [
                'username' => 'yayasan',
                'password' => Hash::make('yayasan'),
                'role'     => 'yayasan',
            ],
            [
                'username' => 'kristo',
                'password' => Hash::make('kristo'),
                'role'     => 'yayasan',
            ],
        ];

        foreach ($userdata as $data) {
            User::create($data);
        }
    }
}