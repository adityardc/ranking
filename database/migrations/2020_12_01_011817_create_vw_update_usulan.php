<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVwUpdateUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW vw_update_usulan AS  SELECT distribusi_karyawans.divisi_id,
        distribusi_karyawans.indikator_id,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "TETAP" THEN 1
                ELSE 0
            END) AS tetap,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "BERKALA I" THEN 1
                ELSE 0
            END) AS berkala_i,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "BERKALA II" THEN 1
                ELSE 0
            END) AS berkala_ii,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "NAIK GOLONGAN NORMAL" THEN 1
                ELSE 0
            END) AS normal,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "NAIK GOLONGAN ISTIMEWA" THEN 1
                ELSE 0
            END) AS istimewa,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "TETAP" THEN 1
                ELSE 0
            END) AS final_tetap,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "BERKALA I" THEN 1
                ELSE 0
            END) AS final_berkala_i,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "BERKALA II" THEN 1
                ELSE 0
            END) AS final_berkala_ii,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "NAIK GOLONGAN NORMAL" THEN 1
                ELSE 0
            END) AS final_normal,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "NAIK GOLONGAN ISTIMEWA" THEN 1
                ELSE 0
            END) AS final_istimewa,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "TETAP" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS karpim_tetap,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "TETAP" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS karpel_tetap,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "BERKALA I" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS karpim_berkala_i,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "BERKALA I" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS karpel_berkala_i,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "BERKALA II" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS karpim_berkala_ii,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "BERKALA II" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS karpel_berkala_ii,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "NAIK GOLONGAN NORMAL" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS karpim_normal,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "NAIK GOLONGAN NORMAL" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS karpel_normal,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "NAIK GOLONGAN ISTIMEWA" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS karpim_istimewa,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian = "NAIK GOLONGAN ISTIMEWA" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS karpel_istimewa,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "TETAP" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS final_karpim_tetap,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "TETAP" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS final_karpel_tetap,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "BERKALA I" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS final_karpim_berkala_i,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "BERKALA I" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS final_karpel_berkala_i,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "BERKALA II" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS final_karpim_berkala_ii,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "BERKALA II" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS final_karpel_berkala_ii,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "NAIK GOLONGAN NORMAL" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS final_karpim_normal,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "NAIK GOLONGAN NORMAL" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS final_karpel_normal,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "NAIK GOLONGAN ISTIMEWA" AND distribusi_karyawans.status = "KARPIM" THEN 1
                ELSE 0
            END) AS final_karpim_istimewa,
        sum(
            CASE
                WHEN distribusi_karyawans.penilaian_final = "NAIK GOLONGAN ISTIMEWA" AND distribusi_karyawans.status = "KARPEL" THEN 1
                ELSE 0
            END) AS final_karpel_istimewa
       FROM distribusi_karyawans
      GROUP BY distribusi_karyawans.indikator_id, distribusi_karyawans.divisi_id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_update_usulan');
    }
}
