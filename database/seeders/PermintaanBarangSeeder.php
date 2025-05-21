<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermintaanBarang;

class PermintaanBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermintaanBarang::create([
            'petani_id' => 4,
            'stok_barang_id' => 1,
            'nama_barang' => 'Pupuk NPK',
            'jumlah' => 50,
            'status' => 'Masuk',
        ]);

        PermintaanBarang::create([
            'petani_id' => 4,
            'stok_barang_id' => 2,
            'nama_barang' => 'Bibit Jagung',
            'jumlah' => 100,
            'status' => 'Masuk',
        ]);

        PermintaanBarang::create([
            'petani_id' => 4,
            'stok_barang_id' => 3,
            'nama_barang' => 'Obat Hama',
            'jumlah' => 20,
            'status' => 'Masuk',
        ]);
    }
}
