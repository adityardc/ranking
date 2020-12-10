<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVwListDistribusi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW vw_list_distribusi AS SELECT distribusis.indikator_id,
        ptpns.company,
        ptpns.id AS ptpn_id,
        divisis.id AS divisi_id,
        divisis.nama_divisi,
        indikators.tahun,
        distribusi_karyawans.usul_approve
       FROM distribusis
         JOIN indikators ON distribusis.indikator_id = indikators.id
         JOIN ptpns ON distribusis.ptpn_id = ptpns.id
         JOIN divisis ON distribusis.divisi_id = divisis.id
         LEFT JOIN distribusi_karyawans ON distribusis.indikator_id = distribusi_karyawans.indikator_id
      GROUP BY distribusis.indikator_id, indikators.tahun, ptpns.company, ptpns.id, divisis.nama_divisi, divisis.id, distribusi_karyawans.usul_approve');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_list_distribusi');
    }
}
