<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableVwListIndikator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW vw_list_indikator AS SELECT
        indikators.id AS indikator_id,
        divisis.id AS divisi_id,
        divisis.ptpn_id,
        divisis.nama_divisi,
        ptpns.company,
        count( distribusi_karyawans.id ) AS jml_karyawan,
        sum( CASE WHEN distribusi_karyawans.penilaian <> "" THEN 1 ELSE 0 END ) AS jml_usulan,
        distribusi_karyawans.usul_approve,
        distribusi_karyawans.final_approve,
        indikators.tahun 
    FROM
        distribusi_karyawans
        JOIN divisis ON distribusi_karyawans.divisi_id = divisis.id
        JOIN ptpns ON distribusi_karyawans.ptpn_id = ptpns.id
        LEFT JOIN indikators ON distribusi_karyawans.indikator_id = indikators.id 
    GROUP BY
        divisis.id,
        divisis.ptpn_id,
        divisis.nama_divisi,
        ptpns.company,
        distribusi_karyawans.final_approve,
        distribusi_karyawans.usul_approve,
        indikators.tahun,
        indikators.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_list_indikator');
    }
}
