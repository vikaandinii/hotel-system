<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarFasilitasTable extends Migration
{ 

    public function up()
    {
        Schema::create('kamar_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kamar');
            $table->unsignedBigInteger('id_fasilitas_kamar');
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_kamar')->references('id')->on('kamars')->onDelete('cascade');
            $table->foreign('id_fasilitas_kamar')->references('id')->on('fasilitas_kamars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kamar_fasilitas');
    } 
}
