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
        Schema::create('distribusi_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permintaan_id')->references('id')->on('permintaan_barangs')->onDelete('cascade');
            $table->foreignId('distributor_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['Proses Pengiriman', 'Selesai', 'Gagal'])->default('Proses Pengiriman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi_barangs');
    }
};
