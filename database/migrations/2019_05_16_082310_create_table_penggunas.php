<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenggunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->String('nama_lengkap');
            $table->text('alamat');
            $table->String('telp');
            $table->enum('golongan_darah',['A','B','AB','O']);
            $table->enum('resus',['POSITIF','NEGATIF','-']);
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
        Schema::dropIfExists('penggunas');
    }
}
