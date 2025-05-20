<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'alamat' => 'Jl. Admin No. 1',
            'nomor_telepon' => '081234567890',
        ]);
        User::create([
            'name' => 'Petugas Gudang 1',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'gudang',
            'alamat' => 'Jl. Petugas No. 1',
            'desa' => 'Desa 1',
            'nomor_telepon' => '081234567891',
        ]);
        User::create([
            'name' => 'Distributor 1',
            'email' => 'distributor@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'distributor',
            'alamat' => 'Jl. Distributor No. 1',
            'desa' => 'Desa 1',
            'nomor_telepon' => '081234567892',
        ]);
        User::create([
            'name' => 'Petani 1',
            'email' => 'petani@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'petani',
            'alamat' => 'Jl. Petani No. 1',
            'desa' => 'Desa 1',
            'nomor_telepon' => '081234567893',
        ]);
    }
}
