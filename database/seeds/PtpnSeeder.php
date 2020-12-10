<?php

use App\Ptpn;
use Illuminate\Database\Seeder;

class PtpnSeeder extends Seeder
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
                'company_code' => 'N000',
                'company'      => 'PT PERKEBUNAN NUSANTARA HOLDING',
                'description'  => 'PT PERKEBUNAN NUSANTARA HOLDING',
                'address'      => 'JAKARTA'
            ),
            array(
                'company_code' => 'N001',
                'company'      => 'PT PERKEBUNAN NUSANTARA I',
                'description'  => 'PT PERKEBUNAN NUSANTARA I',
                'address'      => 'ACEH'
            ),
            array(
                'company_code' => 'N002',
                'company'      => 'PT PERKEBUNAN NUSANTARA II',
                'description'  => 'PT PERKEBUNAN NUSANTARA II',
                'address'      => 'TANJUNG MORAWA'
            ),
            array(
                'company_code' => 'N003',
                'company'      => 'PT PERKEBUNAN NUSANTARA III (PERSERO)',
                'description'  => 'PT PERKEBUNAN NUSANTARA III (PERSERO)',
                'address'      => 'MEDAN'
            ),
            array(
                'company_code' => 'N004',
                'company'      => 'PT PERKEBUNAN NUSANTARA IV',
                'description'  => 'PT PERKEBUNAN NUSANTARA IV',
                'address'      => 'MEDAN'
            ),
            array(
                'company_code' => 'N005',
                'company'      => 'PT PERKEBUNAN NUSANTARA V',
                'description'  => 'PT PERKEBUNAN NUSANTARA V',
                'address'      => 'PEKANBARU'
            ),
            array(
                'company_code' => 'N006',
                'company'      => 'PT PERKEBUNAN NUSANTARA VI',
                'description'  => 'PT PERKEBUNAN NUSANTARA VI',
                'address'      => 'JAMBI'
            ),
            array(
                'company_code' => 'N007',
                'company'      => 'PT PERKEBUNAN NUSANTARA VII',
                'description'  => 'PT PERKEBUNAN NUSANTARA VII',
                'address'      => 'LAMPUNG'
            ),
            array(
                'company_code' => 'N008',
                'company'      => 'PT PERKEBUNAN NUSANTARA VIII',
                'description'  => 'PT PERKEBUNAN NUSANTARA VIII',
                'address'      => 'BANDUNG'
            ),
            array(
                'company_code' => 'N009',
                'company'      => 'PT PERKEBUNAN NUSANTARA IX',
                'description'  => 'PT PERKEBUNAN NUSANTARA IX',
                'address'      => 'SEMARANG'
            ),
            array(
                'company_code' => 'N010',
                'company'      => 'PT PERKEBUNAN NUSANTARA X',
                'description'  => 'PT PERKEBUNAN NUSANTARA X',
                'address'      => 'SURABAYA'
            ),
            array(
                'company_code' => 'N011',
                'company'      => 'PT PERKEBUNAN NUSANTARA XI',
                'description'  => 'PT PERKEBUNAN NUSANTARA XI',
                'address'      => 'SURABAYA'
            ),
            array(
                'company_code' => 'N012',
                'company'      => 'PT PERKEBUNAN NUSANTARA XII',
                'description'  => 'PT PERKEBUNAN NUSANTARA XII',
                'address'      => 'SURABAYA'
            ),
            array(
                'company_code' => 'N013',
                'company'      => 'PT PERKEBUNAN NUSANTARA XIII',
                'description'  => 'PT PERKEBUNAN NUSANTARA XIII',
                'address'      => 'PONTIANAK'
            ),
            array(
                'company_code' => 'N014',
            'company'      => 'PT PERKEBUNAN NUSANTARA XIV',
            'description'  => 'PT PERKEBUNAN NUSANTARA XIV',
            'address'      => 'MAKASAR'
            )
            
        );

        Ptpn::insert($data);
    }
}
