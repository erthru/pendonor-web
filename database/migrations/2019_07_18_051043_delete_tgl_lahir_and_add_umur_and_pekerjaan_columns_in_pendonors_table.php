<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTglLahirAndAddUmurAndPekerjaanColumnsInPendonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendonors', function (Blueprint $table) {
            $table->integer("umur")->after("resus");
            $table->string("pekerjaan")->after("umur");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendonors', function (Blueprint $table) {
            //
        });
    }
}
