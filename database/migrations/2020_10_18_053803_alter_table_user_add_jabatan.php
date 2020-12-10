<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserAddJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sap_id')->nullable();
            $table->integer('jabatan_id')->nullable();
            $table->integer('golongan_id')->nullable();
            $table->integer('mkg_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('sap_id');
            $table->dropColumn('jabatan_id');
            $table->dropColumn('golongan_id');
            $table->dropColumn('mkg_id');
        });
    }
}
