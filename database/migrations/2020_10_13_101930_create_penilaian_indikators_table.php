<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianIndikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_indikators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('indikator_id');
            $table->integer('kpi_id');
            $table->float('rkapp',13,2)->default(0);
            $table->float('realisasi',13,2)->default(0);
            $table->float('kurleb',13,2)->default(0);
            $table->float('persen_selisih',13,2)->default(0);
            $table->float('real_kpi',13,2)->default(0);
            $table->float('rata_rata',13,2)->default(0);
            $table->integer('favor')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('penilaian_indikators');
    }
}
