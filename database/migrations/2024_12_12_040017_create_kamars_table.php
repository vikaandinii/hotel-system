<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarsTable extends Migration
{
    public function up()
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar');
            $table->string('jenis_kamar');
            $table->decimal('harga_per_malam', 10, 2);
            $table->string('status_kamar');
            $table->integer('kapasitas_kamar');
            $table->string('gambar_kamar')->nullable(); 
            $table->timestamps();
        });
    } 

    public function down()
    {
        Schema::dropIfExists('kamars');
    }

}