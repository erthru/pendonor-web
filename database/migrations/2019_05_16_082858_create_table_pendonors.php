<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePendonors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendonors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('nama_lengkap');
            $table->text('alamat');
            $table->String('telp');
            $table->enum('jenkel',['LAKI-LAKI','PEREMPUAN']);
            $table->date('tgl_lahir');
            $table->enum('golongan_darah',['A','B','AB','O']);
            $table->enum('resus',['POSITIF','NEGATIF','-']);
            $table->String('lat');
            $table->String('lng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pendonors');
    }
}
