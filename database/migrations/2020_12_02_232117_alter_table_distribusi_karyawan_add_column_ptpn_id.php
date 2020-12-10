<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDistribusiKaryawanAddColumnPtpnId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distribusi_karyawans', function (Blueprint $table) {
            $table->integer('ptpn_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distribusi_karyawans', function (Blueprint $table) {
            $table->dropColumn('ptpn_id');
        });
    }
}
