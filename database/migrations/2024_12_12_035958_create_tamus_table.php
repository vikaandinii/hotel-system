<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamusTable extends Migration
{
    public function up()
    {
        Schema::create('tamus', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Pastikan menggunakan InnoDB engine

            $table->unsignedBigInteger('id_tamu')->primary(); // id_tamu sebagai primary key
            $table->string('nama_tamu');
            $table->string('no_telp');
            $table->string('jenis_kelamin');
            $table->string('kewarganegaraan');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tamus');
    }
}

