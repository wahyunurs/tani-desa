<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StokBarang;

class StokBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StokBarang::create([
            'gudang_id' => 2,
            'nama_barang' => 'Pupuk NPK',
            'jenis' => 'Pupuk',
            'jumlah' => 100,
            'satuan' => 'kg',
            'batas_minimal' => 10,
        ]);

        StokBarang::create([
            'gudang_id' => 2,
            'nama_barang' => 'Bibit Jagung',
            'jenis' => 'Bibit',
            'jumlah' => 200,
            'satuan' => 'pcs',
            'batas_minimal' => 20,
        ]);

        StokBarang::create([
            'gudang_id' => 2,
            'nama_barang' => 'Obat Hama',
            'jenis' => 'Obat',
            'jumlah' => 50,
            'satuan' => 'liter',
            'batas_minimal' => 5,
        ]);
    }
}
