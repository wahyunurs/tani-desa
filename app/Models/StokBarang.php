<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class StokBarang extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'gudang_id',
        'nama_barang',
        'jenis',
        'jumlah',
        'foto',
        'satuan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'gudang_id');
    }

    public function permintaanBarang()
    {
        return $this->hasMany(PermintaanBarang::class);
    }
}
