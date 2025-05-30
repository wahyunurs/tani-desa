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
            'foto' => 'pupuk_npk.png',
        ]);

        StokBarang::create([
            'gudang_id' => 2,
            'nama_barang' => 'Bibit Jagung',
            'jenis' => 'Bibit',
            'jumlah' => 200,
            'satuan' => 'pcs',
            'foto' => 'bibit_jagung.png',
        ]);

        StokBarang::create([
            'gudang_id' => 2,
            'nama_barang' => 'Obat Hama',
            'jenis' => 'Obat',
            'jumlah' => 50,
            'satuan' => 'liter',
            'foto' => 'obat_hama.png',
        ]);
    }
}
