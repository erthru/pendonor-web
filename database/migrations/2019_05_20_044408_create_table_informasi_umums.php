<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInformasiUmums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_umums', function (Blueprint $table) {
            $table->bigIncrements('id')->unsignted();
            $table->String("judul");
            $table->text("konten");
            $table->unsignedBigInteger("admin_id");
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
        Schema::dropIfExists('table_informasi_umums');
    }
}
