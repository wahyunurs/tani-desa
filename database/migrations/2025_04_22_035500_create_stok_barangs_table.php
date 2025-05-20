<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gudang_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_barang');
            $table->enum('jenis', ['Pupuk', 'Bibit', 'Obat']);
            $table->unsignedInteger('jumlah');
            $table->enum('satuan', ['kg', 'liter', 'pcs']);
            $table->unsignedInteger('batas_minimal')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_barangs');
    }
};
