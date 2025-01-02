<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai dengan database
    protected $table = 'tamus'; // Ganti dengan nama tabel yang benar

    // Menentukan primary key
    protected $primaryKey = 'id_tamu'; // Primary key adalah id_tamu
    public $incrementing = true;
    protected $keyType = 'int';

    

    // Daftar kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_tamu',
        'no_telp',
        'jenis_kelamin',
        'kewarganegaraan',
        'alamat',
        'email',
    ];
   
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_tamu', 'id_tamu');
    }

}

