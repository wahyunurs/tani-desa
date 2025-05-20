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
        Schema::create('permintaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petani_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('stok_barang_id')->constrained('stok_barangs')->onDelete('cascade');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->enum('status', ['Masuk', 'Diproses', 'Selesai', 'Gagal'])->default('Masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barangs');
    }
};
