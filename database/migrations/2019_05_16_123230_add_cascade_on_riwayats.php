<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadeOnRiwayats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayats', function (Blueprint $table) {
            $table->dropForeign('riwayats_pendonor_id_foreign');
            $table->foreign('pendonor_id')->references('id')->on('pendonors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayats', function (Blueprint $table) {
            //
        });
    }
}
