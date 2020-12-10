<?php

use App\Satuan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'kode_satuan' => 'Kg',
                'deskripsi' => 'Kilogram'
            ),
            array(
                'kode_satuan' => 'Rp/Kg',
                'deskripsi' => 'Rupiah per Kilogram'
            ),
            array(
                'kode_satuan' => 'Kg Kering',
                'deskripsi' => 'Kilogram Kering'
            ),
            array(
                'kode_satuan' => 'Kg Kopi Diolah',
                'deskripsi' => 'Kilogram kopi diolah'
            ),
            array(
                'kode_satuan' => 'Ton',
                'deskripsi' => 'Tonase'
            ),
            array(
                'kode_satuan' => 'Jumlah Pohon atau m2 atau Log',
                'deskripsi' => 'Untuk komoditas Kayu'
            ),
            array(
                'kode_satuan' => 'Lembar',
                'deskripsi' => 'Lembar'
            ),
            array(
                'kode_satuan' => 'Rp/Lembar',
                'deskripsi' => 'Rupiah per lembar'
            ),
            array(
                'kode_satuan' => 'Rp',
                'deskripsi' => 'Rupiah'
            ),
            array(
                'kode_satuan' => 'BOR (jumlah kamar terisi)',
                'deskripsi' => 'Jumlah Kamar Terisi'
            ),
            array(
                'kode_satuan' => 'Kg Teh Diolah',
                'deskripsi' => 'Kilogram Teh diolah'
            ),
        );

        Satuan::insert($data);
    }
}
