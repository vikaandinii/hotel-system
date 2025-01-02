<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    use HasFactory;

    protected $table = 'detail_reservasi';

    protected $fillable = [
        'id_reservasi', 
        'id_kamar', 
        'jumlah_hari', 
        'total_harga'
    ];
    

    /**
     * Relasi dengan model Reservasi
     */
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    /**
     * Relasi dengan model Kamar
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id');
    }
}


