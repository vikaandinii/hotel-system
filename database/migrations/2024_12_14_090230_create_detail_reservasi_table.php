<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailReservasiTable extends Migration
{
    public function up()
    {
        Schema::create('detail_reservasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_reservasi'); // Gunakan unsignedBigInteger untuk id_reservasi
            $table->unsignedBigInteger('id_kamar'); // Gunakan unsignedBigInteger untuk id_kamar
            $table->integer('jumlah_hari');
            $table->timestamps();

            // Definisikan foreign key untuk id_reservasi
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');
            
            // Definisikan foreign key untuk id_kamar
            $table->foreign('id_kamar')->references('id')->on('kamars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_reservasi');
    }
}

