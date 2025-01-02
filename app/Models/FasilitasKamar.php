<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasKamar extends Model
{
    use HasFactory;

    protected $table = 'fasilitas_kamars'; // Nama tabel di database
    protected $primaryKey = 'id_fasilitas_kamar'; // Nama kolom primary key
    protected $fillable = ['nama_fasilitas']; // Kolom yang bisa diisi


    public function kamars()
    {
    return $this->belongsToMany(\App\Models\Kamar::class, 'kamar_fasilitas', 'id_fasilitas_kamar', 'id_kamar');
    }


}

