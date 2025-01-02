<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $primaryKey = 'id'; // Ganti 'id_kamar' menjadi 'id' untuk mencocokkan dengan struktur tabel

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nomor_kamar',
        'jenis_kamar',
        'harga_per_malam',
        'status_kamar',
        'kapasitas_kamar',
        'gambar_kamar', // Gambar hanya berupa path string, bukan array
    ];

    public function fasilitas()
    {
    return $this->belongsToMany(\App\Models\FasilitasKamar::class, 'kamar_fasilitas', 'id_kamar', 'id_fasilitas_kamar');
    }

    // Relasi dengan DetailReservasi
    public function detailReservasi()
    {
        return $this->hasMany(DetailReservasi::class, 'id_kamar', 'id');
    }

        // Definisikan metode reservasi
    public function reservasis()
    {
        return $this->belongsToMany(Reservasi::class, 'reservasi_kamar', 'id_kamar', 'id_reservasi');
    }

    public function reservasi()
    {
    return $this->belongsToMany(\App\Models\Reservasi::class, 'detail_reservasi', 'id_kamar', 'id_reservasi');
    }
}
