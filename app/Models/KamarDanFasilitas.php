<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarDanFasilitas extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'kamar_fasilitas';  
    
    // Tentukan primary key jika tidak menggunakan id default
    protected $primaryKey = 'id_kamar_fasilitas';

    // Kolom yang dapat diisi
    protected $fillable = ['id_kamar', 'id_fasilitas'];

    // Pastikan timestamps diatur jika Anda ingin menggunakannya
    public $timestamps = true;  // ini untuk menggunakan created_at dan updated_at
}


