<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Laporan extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'barang_id',
        'nama_barang',
        'jumlah',
        'status',
        'tanggal',
    ];

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'barang_id');
    }
}
