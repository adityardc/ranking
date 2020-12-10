<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianKaryasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_karyas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ptpn_id');
            $table->string('rangking');
            $table->string('jenis_rkap');
            $table->integer('min');
            $table->integer('max');
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
        Schema::dropIfExists('penilaian_karyas');
    }
}
