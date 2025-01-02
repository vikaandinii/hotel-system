<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $primaryKey = 'id_reservasi';
    public $incrementing = true;
    protected $keyType = 'int';
    

    protected $fillable = [
        'id_tamu', 
        'tanggal_checkin', 
        'tanggal_checkout', 
        'total_harga', 
        'status_reservasi', 
        'metode_pembayaran'
    ];

    protected $casts = [
        'tanggal_checkin' => 'datetime',
        'tanggal_checkout' => 'datetime',
    ];

    public function kamars()
    {
        return $this->belongsToMany(Kamar::class, 'detail_reservasi', 'id_reservasi', 'id_kamar')->withPivot('jumlah_hari');
    }


    public function detailReservasi()
    {
        return $this->hasMany(DetailReservasi::class, 'id_reservasi', 'id_reservasi');
    }

    // Relasi ke Tamu
    public function tamu()
    {
        return $this->belongsTo(Tamu::class, 'id_tamu', 'id_tamu'); // Menentukan kolom foreign key
    }

    // Relasi ke model Kamar
    /*
    public function kamars()
    {
        return $this->belongsToMany(Kamar::class, 'detail_reservasi', 'id_reservasi', 'id_kamar')
                    ->withPivot('jumlah_hari')
                    ->withTimestamps();
    } */

}

