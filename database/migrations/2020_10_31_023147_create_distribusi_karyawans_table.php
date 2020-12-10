<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusiKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribusi_karyawans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nik');
            $table->integer('divisi_id');
            $table->text('sub_bagian');
            $table->string('gol_awal', 4);
            $table->string('mkg_awal', 2);
            $table->string('penilaian')->nullable();
            $table->integer('indikator_id')->nullable();
            $table->string('gol_usul', 4)->nullable();
            $table->string('mkg_usul', 2)->nullable();
            $table->string('gol_final', 4)->nullable();
            $table->string('mkg_final', 2)->nullable();
            $table->integer('usul_approve');
            $table->integer('final_approve');
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
        Schema::dropIfExists('distribusi_karyawans');
    }
}
