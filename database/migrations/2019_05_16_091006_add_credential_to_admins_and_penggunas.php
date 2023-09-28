<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCredentialToAdminsAndPenggunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->String('email')->after('alamat');
            $table->String('password')->after('email');
        });

        Schema::table('penggunas', function (Blueprint $table) {
            $table->String('email')->after('resus');
            $table->String('password')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins_and_penggunas', function (Blueprint $table) {
            //
        });
    }
}
