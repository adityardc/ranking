<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVwRataRataKpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW vw_rata_rata_kpi AS SELECT cast(avg(penilaian_indikators.real_kpi) AS decimal(10,2)) AS rata_rata,
        penilaian_indikators.indikator_id,
        indikators.divisi_id,
        indikators.tahun
       FROM penilaian_indikators
         JOIN indikators ON penilaian_indikators.indikator_id = indikators.id
      GROUP BY penilaian_indikators.indikator_id, indikators.divisi_id, indikators.tahun');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_rata_rata_kpi');
    }
}
