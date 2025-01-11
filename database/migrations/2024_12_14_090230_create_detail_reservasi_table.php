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
            $table->unsignedBigInteger('id_reservasi');
            $table->unsignedBigInteger('id_kamar'); 
            $table->integer('jumlah_hari');
            $table->timestamps();


            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');
            
            $table->foreign('id_kamar')->references('id')->on('kamars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_reservasi');
    }
}

