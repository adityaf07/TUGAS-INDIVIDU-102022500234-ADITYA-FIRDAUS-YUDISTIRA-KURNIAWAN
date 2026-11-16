<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            [
                'name'     => 'Administrator',
                'email'    => 'admin@gmail.com',
                'password' => 'admin12345',
                'role'     => 'admin',
            ],
            [
                'name'     => 'Staff Toko',
                'email'    => 'staff@gmail.com',
                'password' => 'staff12345',
                'role'     => 'staff',
            ],
            [
                'name'     => 'Viewer',
                'email'    => 'viewer@gmail.com',
                'password' => 'viewer12345',
                'role'     => 'viewer',
            ],
        ];

        foreach ($akun as $a) {
            User::updateOrCreate(
                ['email' => $a['email']],
                [
                    'name'     => $a['name'],
                    'password' => Hash::make($a['password']),
                    'role'     => $a['role'],
                ]
            );
        }
    }
}