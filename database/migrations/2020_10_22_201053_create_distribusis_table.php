<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribusis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ptpn_id');
            $table->integer('divisi_id');
            $table->integer('indikator_id');
            $table->string('rangking');
            $table->integer('min_persen');
            $table->integer('max_persen');
            $table->integer('min_orang');
            $table->integer('max_orang');
            $table->integer('usulan_karpim')->default(0)->nullable();
            $table->integer('usulan_karpel')->default(0)->nullable();
            $table->integer('usulan_jumlah')->default(0)->nullable();
            $table->string('usulan_range', 5)->nullable();
            $table->integer('hasil_karpim')->default(0)->nullable();
            $table->integer('hasil_karpel')->default(0)->nullable();
            $table->integer('hasil_jumlah')->default(0)->nullable();
            $table->string('hasil_range', 5)->nullable();
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
        Schema::dropIfExists('distribusis');
    }
}
