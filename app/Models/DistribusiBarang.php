<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class DistribusiBarang extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'permintaan_id',
        'distributor_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'distributor_id', 'id');
    }

    public function permintaanBarang()
    {
        return $this->belongsTo(PermintaanBarang::class, 'permintaan_id', 'id');
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id', 'id');
    }
}
