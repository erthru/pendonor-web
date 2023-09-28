<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveForeignOnPendonors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendonors', function (Blueprint $table) {
            $table->dropForeign("pendonors_provinsi_id_foreign");
            $table->dropForeign("pendonors_kotakabu_id_foreign");
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
