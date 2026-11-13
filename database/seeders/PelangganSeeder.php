<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Budi Santoso', 'budi@example.com', '081234567801', 'VIP', 'Jl. Merdeka No. 10, Bandung'],
            ['Siti Aminah', 'siti@example.com', '081234567802', 'Gold', 'Jl. Dago No. 25, Bandung'],
            ['Andi Pratama', 'andi@example.com', '081234567803', 'Basic', 'Jl. Buah Batu No. 7, Bandung'],
            ['Rina Wulandari', 'rina@example.com', '081234567804', 'Gold', 'Jl. Cihampelas No. 33, Bandung'],
        ];

        foreach ($data as [$nama, $email, $telepon, $level, $alamat]) {
            Pelanggan::updateOrCreate(['email' => $email], [
                'nama'         => $nama,
                'telepon'      => $telepon,
                'level_member' => $level,
                'alamat'       => $alamat,
            ]);
        }
    }
}