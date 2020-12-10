<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisis')->insert([
            'ptpn_id'     => 1,
            'kode_divisi' => 'SDM',
            'nama_divisi' => 'SDM'
        ]);
    }
}
