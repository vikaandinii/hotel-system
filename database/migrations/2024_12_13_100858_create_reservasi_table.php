<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Pastikan menggunakan InnoDB engine

            $table->bigIncrements('id_reservasi');
            $table->unsignedBigInteger('id_tamu'); // id_tamu sebagai foreign key
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->decimal('total_harga', 15, 2);
            $table->string('status_reservasi');
            $table->string('metode_pembayaran');
            $table->timestamps();
  
            // Mendefinisikan foreign key constraint
            $table->foreign('id_tamu')
                  ->references('id_tamu')
                  ->on('tamus')
                  ->onDelete('cascade'); // Menghapus reservasi jika tamu dihapus
        });
    }


    public function down()
    {
        Schema::dropIfExists('reservasi');
    } 

}
