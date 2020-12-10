<?php

use App\Golongan;
use Illuminate\Database\Seeder;

class GolonganTableSeeder extends Seeder
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
                'nama_golongan' => 'IA',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'IB',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'IC',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'ID',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'IIA',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'IIB',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'IIC',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'IID',
                'status' => 'KARPEL'
            ),
            array(
                'nama_golongan' => 'IIIA',
                'status' => 'KARPIM'
            ),
            array(
                'nama_golongan' => 'IIIB',
                'status' => 'KARPIM'
            ),
            array(
                'nama_golongan' => 'IIIC',
                'status' => 'KARPIM'
            ),
            array(
                'nama_golongan' => 'IIID',
                'status' => 'KARPIM'
            ),
            array(
                'nama_golongan' => 'IVA',
                'status' => 'KARPIM'
            ),
            array(
                'nama_golongan' => 'IVB',
                'status' => 'KARPIM'
            ),
            array(
                'nama_golongan' => 'IVC',
                'status' => 'KARPIM'
            ),
            array(
                'nama_golongan' => 'IVD',
                'status' => 'KARPIM'
            )
        );

        Golongan::insert($data);
    }
}
