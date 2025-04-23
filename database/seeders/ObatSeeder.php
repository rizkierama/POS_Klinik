<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Obat;
class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obat::create([
            'nama_obat' => 'Paracetamol',
            'stok' => 50,
            'harga' => 5000
        ]);

        Obat::create([
            'nama_obat' => 'Amoxicillin',
            'stok' => 30,
            'harga' => 8000
        ]);
    }
}
