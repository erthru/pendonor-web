<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveProvinsiAndKotakabuOnTablePendonors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendonors', function (Blueprint $table) {
            $table->dropColumn(["provinsi_id","kotakabu_id"]);
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
