<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DistribusiBarang;

class DistribusiBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DistribusiBarang::create([
            'permintaan_id' => 1,
            'distributor_id' => 3,
            'status' => 'Proses Pengiriman',
        ]);

        DistribusiBarang::create([
            'permintaan_id' => 2,
            'distributor_id' => 3,
            'status' => 'Selesai',
        ]);

        DistribusiBarang::create([
            'permintaan_id' => 3,
            'distributor_id' => 3,
            'status' => 'Gagal',
        ]);
    }
}
