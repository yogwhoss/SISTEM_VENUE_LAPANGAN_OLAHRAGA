<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['Admin Toko',   'admin@example.com',  User::ROLE_ADMIN],
            ['Staff Toko',   'staff@example.com',  User::ROLE_STAFF],
            ['Viewer Toko',  'viewer@example.com', User::ROLE_VIEWER],
        ];

        foreach ($akun as [$name, $email, $role]) {
            User::updateOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => 'password123', 'role' => $role],
            );
        }

        $this->call(PelangganSeeder::class);
    }
}
