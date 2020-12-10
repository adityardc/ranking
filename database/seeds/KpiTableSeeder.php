<?php

use App\Kpi;
use Illuminate\Database\Seeder;

class KpiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array("nama_kpi" => "PRODUKSI SAWIT ", "kategori_id" => 1, "satuan_id" => 1, "icon" => 0),
            array("nama_kpi" => "HARGA POKOK TANAMAN KELAPA SAWIT ", "kategori_id" => 1, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "HARGA POKOK PENGOLAHAN ", "kategori_id" => 2, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "TON TBS  OLAH ", "kategori_id" => 2, "satuan_id" => 1, "icon" => 0),
            array("nama_kpi" => "PRODUKSI GULA/ GULA MILIK PG ", "kategori_id" => 3, "satuan_id" => 5, "icon" => 0),
            array("nama_kpi" => "HARGA  POKOK PRODUKSI ", "kategori_id" => 3, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "TETES MILIK PG ", "kategori_id" => 3, "satuan_id" => 5, "icon" => 0),
            array("nama_kpi" => "PRODUKSI KARET ", "kategori_id" => 4, "satuan_id" => 1, "icon" => 0),
            array("nama_kpi" => "HARGA POKOK TANAMAN  KARET ", "kategori_id" => 4, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "VOLUME PRODUKSI KARET ", "kategori_id" => 5, "satuan_id" => 3, "icon" => 0),
            array("nama_kpi" => "HARGA  POKOK PENGOLAHAN KARET ", "kategori_id" => 5, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "PRODUKSI KOPI ", "kategori_id" => 6, "satuan_id" => 1, "icon" => 0),
            array("nama_kpi" => " HARGA POKOK TANAMAN  KOPI ", "kategori_id" => 6, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "VOLUME PRODUKSI KOPI ", "kategori_id" => 7, "satuan_id" => 4, "icon" => 0),
            array("nama_kpi" => "HARGA POKOK PENGOLAHAN KOPI ", "kategori_id" => 7, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "PRODUKSI TEH ", "kategori_id" => 8, "satuan_id" => 1, "icon" => 0),
            array("nama_kpi" => "HARGA POKOK TANAMAN TEH ", "kategori_id" => 8, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "VOLUME PRODUKSI TEH ", "kategori_id" => 9, "satuan_id" => 11, "icon" => 0),
            array("nama_kpi" => "HARGA  POKOK TANAMAN TEH ", "kategori_id" => 9, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "PRODUKSI KAKAO ", "kategori_id" => 10, "satuan_id" => 1, "icon" => 0),
            array("nama_kpi" => "HARGA POKOK TANAMAN  KAKAO ", "kategori_id" => 10, "satuan_id" => 2, "icon" => 1),
            array("nama_kpi" => "PRODUKSI ", "kategori_id" => 11, "satuan_id" => 6, "icon" => 0),
            array("nama_kpi" => "PRODUKSI ", "kategori_id" => 12, "satuan_id" => 7, "icon" => 0),
            array("nama_kpi" => "HARGA POKOK PRODUKSI   ", "kategori_id" => 12, "satuan_id" => 8, "icon" => 1),
            array("nama_kpi" => "PENDAPATAN ", "kategori_id" => 13, "satuan_id" => 9, "icon" => 0),
            array("nama_kpi" => "BIAYA OPERASIONAL ", "kategori_id" => 13, "satuan_id" => 9, "icon" => 1),
            array("nama_kpi" => "BOR ", "kategori_id" => 14, "satuan_id" => 10, "icon" => 0),
            array("nama_kpi" => "PRODUKSI ", "kategori_id" => 15, "satuan_id" => 1, "icon" => 0),
            array("nama_kpi" => "HARGA POKOK PRODUKSI   ", "kategori_id" => 15, "satuan_id" => 2, "icon" => 1),
        );

        Kpi::insert($data);
    }
}
