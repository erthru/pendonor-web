<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldOnPenggunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('telp');
            $table->dropColumn('golongan_darah');
            $table->dropColumn('resus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penggunas', function (Blueprint $table) {
            //
        });
    }
}
