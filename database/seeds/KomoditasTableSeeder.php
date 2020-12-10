<?php

use App\Kategori;
use Illuminate\Database\Seeder;

class KomoditasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('nama_kategori' => 'KELAPA SAWIT'),
            array('nama_kategori' => 'PKS'),
            array('nama_kategori' => 'PABRIK GULA'),
            array('nama_kategori' => 'KARET'),
            array('nama_kategori' => 'PPK'),
            array('nama_kategori' => 'KOPI'),
            array('nama_kategori' => 'PABRIK KOPI'),
            array('nama_kategori' => 'TEH'),
            array('nama_kategori' => 'PABRIK TEH'),
            array('nama_kategori' => 'KAKAO'),
            array('nama_kategori' => 'KAYU'),
            array('nama_kategori' => 'KARUNG'),
            array('nama_kategori' => 'AGROWISATA'),
            array('nama_kategori' => 'RUMAH SAKIT'),
            array('nama_kategori' => 'SERAI WANGI')
        );

        Kategori::insert($data);
    }
}
