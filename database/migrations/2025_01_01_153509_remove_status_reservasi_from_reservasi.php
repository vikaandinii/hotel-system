<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStatusReservasiFromReservasi extends Migration
{
    public function up()
    {
        // Menghapus kolom 'status_reservasi' dari tabel 'reservasi'
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn('status_reservasi');
        });
    }

    public function down()
    {
        // Jika rollback, kembalikan kolom 'status_reservasi'
        Schema::table('reservasi', function (Blueprint $table) {
            $table->string('status_reservasi')->nullable();  // Tipe data yang sama dengan sebelumnya
        });
    }
}
